<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\PullRequestReview;

use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReview;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Hook\PullRequestReview\DismissedPullRequestReviewSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Hook\PullRequestReview\DismissedPullRequestReviewTest
 */
class DismissedPullRequestReview implements PullRequestReviewEvent
{
    /** @var PullRequestReview */
    private $review;

    /** @var PullRequest */
    private $pullRequest;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    public function __construct(
        PullRequestReview $review,
        PullRequest $pullRequest,
        Repo $repo,
        InstallationId $installationId,
        Sender $sender
    ) {
        $this->review         = $review;
        $this->pullRequest    = $pullRequest;
        $this->repo           = $repo;
        $this->installationId = $installationId;
        $this->sender         = $sender;
    }

    public function getReview(): PullRequestReview
    {
        return $this->review;
    }

    public function getPullRequest(): PullRequest
    {
        return $this->pullRequest;
    }

    public function getRepo(): Repo
    {
        return $this->repo;
    }

    public function getRepoId(): RepoId
    {
        return $this->repo->getId();
    }

    public function getRepoFullName(): RepoFullName
    {
        return $this->repo->getFullName();
    }

    public function getInstallationId(): InstallationId
    {
        return $this->installationId;
    }

    public function getSender(): Sender
    {
        return $this->sender;
    }

    public function serialize(): array
    {
        return [
            'review'         => $this->review->serialize(),
            'pullRequest'    => $this->pullRequest->serialize(),
            'repo'           => $this->repo->serialize(),
            'installationId' => $this->installationId->serialize(),
            'sender'         => $this->sender->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            PullRequestReview::deserialize($data['review']),
            PullRequest::deserialize($data['pullRequest']),
            Repo::deserialize($data['repo']),
            InstallationId::deserialize($data['installationId']),
            Sender::deserialize($data['sender'])
        );
    }
}
