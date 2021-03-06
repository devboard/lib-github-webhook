<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview;

use DateTime;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHub\PullRequest\PullRequestAssigneeCollection;
use DevboardLib\GitHub\PullRequest\PullRequestBody;
use DevboardLib\GitHub\PullRequest\PullRequestClosedAt;
use DevboardLib\GitHub\PullRequest\PullRequestCreatedAt;
use DevboardLib\GitHub\PullRequest\PullRequestId;
use DevboardLib\GitHub\PullRequest\PullRequestNumber;
use DevboardLib\GitHub\PullRequest\PullRequestState;
use DevboardLib\GitHub\PullRequest\PullRequestTitle;
use DevboardLib\GitHub\PullRequest\PullRequestUpdatedAt;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedReviewerCollection;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeamCollection;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestStats;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestUrls;
use DevboardLib\GitHubWebhook\CoreFactory\Milestone\GitHubMilestoneFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestAssigneeFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestAuthorFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestBaseFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestHeadFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestMergedByFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestRequestedReviewerFactory;

/**
 * @see GitHubPullRequestFactorySpec
 * @see GitHubPullRequestFactoryTest
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class GitHubPullRequestFactory
{
    /** @var GitHubPullRequestAuthorFactory */
    private $authorFactory;

    /** @var GitHubPullRequestAssigneeFactory */
    private $assigneeFactory;

    /** @var GitHubMilestoneFactory */
    private $milestoneFactory;

    /** @var GitHubPullRequestMergedByFactory */
    private $mergedByFactory;

    /** @var GitHubPullRequestRequestedReviewerFactory */
    private $requestedReviewerFactory;

    /** @var GitHubPullRequestBaseFactory */
    private $baseFactory;

    /** @var GitHubPullRequestHeadFactory */
    private $headFactory;

    public function __construct(
        GitHubPullRequestAuthorFactory $authorFactory,
        GitHubPullRequestAssigneeFactory $assigneeFactory,
        GitHubMilestoneFactory $milestoneFactory,
        GitHubPullRequestMergedByFactory $mergedByFactory,
        GitHubPullRequestRequestedReviewerFactory $requestedReviewerFactory,
        GitHubPullRequestBaseFactory $baseFactory,
        GitHubPullRequestHeadFactory $headFactory
    ) {
        $this->authorFactory            = $authorFactory;
        $this->assigneeFactory          = $assigneeFactory;
        $this->milestoneFactory         = $milestoneFactory;
        $this->mergedByFactory          = $mergedByFactory;
        $this->requestedReviewerFactory = $requestedReviewerFactory;
        $this->baseFactory              = $baseFactory;
        $this->headFactory              = $headFactory;
    }

    public function create(array $data): PullRequest
    {
        if (null === $data['closed_at']) {
            $closedAt = null;
        } else {
            $closedAt = new PullRequestClosedAt($data['closed_at']);
        }

        $assignees = new PullRequestAssigneeCollection([]);

        foreach ($data['assignees'] as $assigneeData) {
            $assignees->add($this->assigneeFactory->create($assigneeData));
        }

        if (null === $data['milestone']) {
            $milestone = null;
        } else {
            $milestone = $this->milestoneFactory->create($data['milestone']);
        }

        if (true === array_key_exists('author_association', $data)) {
            $authorAssociation = $data['author_association'];
        } else {
            $authorAssociation = null;
        }

        if (null === $data['merge_commit_sha']) {
            $mergeCommitSha = null;
        } else {
            $mergeCommitSha = new CommitSha($data['merge_commit_sha']);
        }

        if (null === $data['merged_at']) {
            $mergedAt = null;
            $merged   = false;
        } else {
            $mergedAt = new DateTime($data['merged_at']);
            $merged   = true;
        }

        if (false === array_key_exists('merged_by', $data) || null === $data['merged_by']) {
            $mergedBy = null;
        } else {
            $mergedBy = $this->mergedByFactory->create($data['merged_by']);
        }

        $pullRequestUrls = new PullRequestUrls(
            $data['comments_url'],
            $data['commits_url'],
            $data['diff_url'],
            $data['issue_url'],
            $data['patch_url'],
            $data['review_comment_url'],
            $data['review_comments_url'],
            $data['statuses_url']
        );

        $pullRequestStats = new PullRequestStats(0, 0, 0, 0, 0);

        $requestedTeams = new PullRequestRequestedTeamCollection();

        return new PullRequest(
            new PullRequestId($data['id']),
            new PullRequestNumber($data['number']),
            $this->baseFactory->create($data['base']),
            $this->headFactory->create($data['head']),
            new PullRequestTitle($data['title']),
            new PullRequestBody((string) $data['body']),
            new PullRequestState($data['state']),
            $this->authorFactory->create($data['user'], $authorAssociation),
            $assignees,
            $this->getRequestedReviewers($data['requested_reviewers']),
            $requestedTeams,
            $data['locked'],
            null,
            //@TODO
            false,
            //@TODO
            $mergeCommitSha,
            null,
            //@TODO
            'TODO',
            $merged,
            //@TODO
            $mergedAt,
            $mergedBy,
            $milestone,
            $closedAt,
            $pullRequestStats,
            $pullRequestUrls,
            new PullRequestCreatedAt($data['created_at']),
            new PullRequestUpdatedAt($data['updated_at'])
        );
    }

    private function getRequestedReviewers(array $data): PullRequestRequestedReviewerCollection
    {
        $collection = new PullRequestRequestedReviewerCollection();

        foreach ($data as $item) {
            $collection->add($this->requestedReviewerFactory->create($item));
        }

        return $collection;
    }
}
