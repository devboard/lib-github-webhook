<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview;

use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewBody;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewId;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewState;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewSubmittedAt;
use DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReview;

/**
 * @see GitHubPullRequestReviewFactorySpec
 * @see GitHubPullRequestReviewFactoryTest
 */
class GitHubPullRequestReviewFactory
{
    /** @var GitHubPullRequestReviewAuthorFactory */
    private $authorFactory;

    public function __construct(GitHubPullRequestReviewAuthorFactory $authorFactory)
    {
        $this->authorFactory = $authorFactory;
    }

    public function create(array $data): PullRequestReview
    {
        if (true === array_key_exists('author_association', $data)) {
            $authorAssociation = $data['author_association'];
        } else {
            $authorAssociation = null;
        }

        if (null === $data['submitted_at']) {
            $submittedAt = null;
        } else {
            $submittedAt = new PullRequestReviewSubmittedAt($data['submitted_at']);
        }

        return new PullRequestReview(
            new PullRequestReviewId($data['id']),
            new PullRequestReviewBody((string) $data['body']),
            $this->authorFactory->create($data['user'], $authorAssociation),
            new PullRequestReviewState($data['state']),
            new CommitSha($data['commit_id']),
            $submittedAt
        );
    }
}
