<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\PullRequest;

use DevboardLib\GitHub\GitHubLabelCollection;
use DevboardLib\GitHub\PullRequest\PullRequestApiUrl;
use DevboardLib\GitHub\PullRequest\PullRequestAssigneeCollection;
use DevboardLib\GitHub\PullRequest\PullRequestBody;
use DevboardLib\GitHub\PullRequest\PullRequestClosedAt;
use DevboardLib\GitHub\PullRequest\PullRequestCreatedAt;
use DevboardLib\GitHub\PullRequest\PullRequestHtmlUrl;
use DevboardLib\GitHub\PullRequest\PullRequestId;
use DevboardLib\GitHub\PullRequest\PullRequestNumber;
use DevboardLib\GitHub\PullRequest\PullRequestState;
use DevboardLib\GitHub\PullRequest\PullRequestTitle;
use DevboardLib\GitHub\PullRequest\PullRequestUpdatedAt;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\CoreFactory\Label\GitHubLabelFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Milestone\GitHubMilestoneFactory;

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

    /** @var GitHubLabelFactory */
    private $labelFactory;

    /** @var GitHubMilestoneFactory */
    private $milestoneFactory;

    public function __construct(
        GitHubPullRequestAuthorFactory $authorFactory,
        GitHubPullRequestAssigneeFactory $assigneeFactory,
        GitHubLabelFactory $labelFactory,
        GitHubMilestoneFactory $milestoneFactory
    ) {
        $this->authorFactory    = $authorFactory;
        $this->assigneeFactory  = $assigneeFactory;
        $this->labelFactory     = $labelFactory;
        $this->milestoneFactory = $milestoneFactory;
    }

    public function create(array $data): PullRequest
    {
        if (null === $data['assignee']) {
            $assignee = null;
        } else {
            $assignee = $this->assigneeFactory->create($data['assignee']);
        }

        if (null === $data['closed_at']) {
            $closedAt = null;
        } else {
            $closedAt = new PullRequestClosedAt($data['closed_at']);
        }

        $assignees = new PullRequestAssigneeCollection([]);

        foreach ($data['assignees'] as $assigneeData) {
            $assignees->add($this->assigneeFactory->create($assigneeData));
        }

        $labels = new GitHubLabelCollection([]);
        /*
        foreach ($data['labels'] as $labelData) {
            $labels->add(
                $this->labelFactory->create($labelData)
            );
        }
        */
        if (null === $data['milestone']) {
            $milestone = null;
        } else {
            $milestone = $this->milestoneFactory->create($data['milestone']);
        }

        return new PullRequest(
            new PullRequestId($data['id']),
            new PullRequestNumber($data['number']),
            new PullRequestTitle($data['title']),
            new PullRequestBody((string) $data['body']),
            new PullRequestState($data['state']),
            $this->authorFactory->create($data['user']),
            new PullRequestApiUrl($data['url']),
            new PullRequestHtmlUrl($data['html_url']),
            $assignee,
            $assignees,
            $labels,
            $milestone,
            $closedAt,
            new PullRequestCreatedAt($data['created_at']),
            new PullRequestUpdatedAt($data['updated_at'])
        );
    }
}
