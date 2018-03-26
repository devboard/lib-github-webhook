<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\PullRequest;

use DevboardLib\GitHub\GitHubLabel;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHub\Label\LabelId;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Hook\PullRequest\UnlabeledPullRequestEventSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Hook\PullRequest\UnlabeledPullRequestEventTest
 */
class UnlabeledPullRequestEvent implements PullRequestEvent
{
    /** @var PullRequest */
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
        PullRequest $pullRequest, GitHubLabel $label, Repo $repo, InstallationId $installationId, Sender $sender
    ) {
        $this->pullRequest    = $pullRequest;
        $this->label          = $label;
        $this->repo           = $repo;
        $this->installationId = $installationId;
        $this->sender         = $sender;
    }

    public function getPullRequest(): PullRequest
    {
        return $this->pullRequest;
    }

    public function getLabel(): GitHubLabel
    {
        return $this->label;
    }

    public function getLabelId(): LabelId
    {
        return $this->label->getId();
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
            'label'          => $this->label->serialize(),
            'repo'           => $this->repo->serialize(),
            'installationId' => $this->installationId->serialize(),
            'sender'         => $this->sender->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            PullRequest::deserialize($data['pullRequest']),
            GitHubLabel::deserialize($data['label']),
            Repo::deserialize($data['repo']),
            InstallationId::deserialize($data['installationId']),
            Sender::deserialize($data['sender'])
        );
    }
}
