<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\PullRequest;

use DevboardLib\GitHub\GitHubPullRequest;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Hook\PullRequest\ReopenedPullRequestEventSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Hook\PullRequest\ReopenedPullRequestEventTest
 */
class ReopenedPullRequestEvent implements PullRequestEvent
{
    /** @var GitHubPullRequest */
    private $pullRequest;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    public function __construct(
        GitHubPullRequest $pullRequest, Repo $repo, InstallationId $installationId, Sender $sender
    ) {
        $this->pullRequest    = $pullRequest;
        $this->repo           = $repo;
        $this->installationId = $installationId;
        $this->sender         = $sender;
    }

    public function getPullRequest(): GitHubPullRequest
    {
        return $this->pullRequest;
    }

    public function getRepo(): Repo
    {
        return $this->repo;
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
            'repo'           => $this->repo->serialize(),
            'installationId' => $this->installationId->serialize(),
            'sender'         => $this->sender->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            GitHubPullRequest::deserialize($data['pullRequest']),
            Repo::deserialize($data['repo']),
            InstallationId::deserialize($data['installationId']),
            Sender::deserialize($data['sender'])
        );
    }
}
