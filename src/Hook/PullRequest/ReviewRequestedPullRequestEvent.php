<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\PullRequest;

use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHub\PullRequest\PullRequestReviewer;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Hook\PullRequest\ReviewRequestedPullRequestEventSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Hook\PullRequest\ReviewRequestedPullRequestEventTest
 */
class ReviewRequestedPullRequestEvent implements PullRequestEvent
{
    /** @var PullRequest */
    private $pullRequest;

    /** @var PullRequestReviewer */
    private $reviewer;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    public function __construct(
        PullRequest $pullRequest,
        PullRequestReviewer $reviewer,
        Repo $repo,
        InstallationId $installationId,
        Sender $sender
    ) {
        $this->pullRequest    = $pullRequest;
        $this->reviewer       = $reviewer;
        $this->repo           = $repo;
        $this->installationId = $installationId;
        $this->sender         = $sender;
    }

    public function getPullRequest(): PullRequest
    {
        return $this->pullRequest;
    }

    public function getReviewer(): PullRequestReviewer
    {
        return $this->reviewer;
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
            'pullRequest'    => $this->pullRequest->serialize(),
            'reviewer'       => $this->reviewer->serialize(),
            'repo'           => $this->repo->serialize(),
            'installationId' => $this->installationId->serialize(),
            'sender'         => $this->sender->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            PullRequest::deserialize($data['pullRequest']),
            PullRequestReviewer::deserialize($data['reviewer']),
            Repo::deserialize($data['repo']),
            InstallationId::deserialize($data['installationId']),
            Sender::deserialize($data['sender'])
        );
    }
}
