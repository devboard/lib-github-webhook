<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\PullRequest;

use DevboardLib\GitHub\GitHubLabel;
use DevboardLib\GitHub\GitHubPullRequest;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Hook\PullRequest\UnlabeledPullRequestEventSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Hook\PullRequest\UnlabeledPullRequestEventTest
 */
class UnlabeledPullRequestEvent implements PullRequestEvent
{
    /** @var GitHubPullRequest */
    private $pullRequest;

    /** @var GitHubLabel */
    private $label;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    public function __construct(
        GitHubPullRequest $pullRequest,
        GitHubLabel $label,
        Repo $repo,
        InstallationId $installationId,
        Sender $sender
    ) {
        $this->pullRequest    = $pullRequest;
        $this->label          = $label;
        $this->repo           = $repo;
        $this->installationId = $installationId;
        $this->sender         = $sender;
    }

    public function getPullRequest(): GitHubPullRequest
    {
        return $this->pullRequest;
    }

    public function getLabel(): GitHubLabel
    {
        return $this->label;
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
            'label'          => $this->label->serialize(),
            'repo'           => $this->repo->serialize(),
            'installationId' => $this->installationId->serialize(),
            'sender'         => $this->sender->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            GitHubPullRequest::deserialize($data['pullRequest']),
            GitHubLabel::deserialize($data['label']),
            Repo::deserialize($data['repo']),
            InstallationId::deserialize($data['installationId']),
            Sender::deserialize($data['sender'])
        );
    }
}
