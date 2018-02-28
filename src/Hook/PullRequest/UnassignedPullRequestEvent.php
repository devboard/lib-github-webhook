<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\PullRequest;

use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHub\PullRequest\PullRequestAssignee;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Hook\PullRequest\UnassignedPullRequestEventSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Hook\PullRequest\UnassignedPullRequestEventTest
 */
class UnassignedPullRequestEvent implements PullRequestEvent
{
    /** @var PullRequest */
    private $pullRequest;

    /** @var PullRequestAssignee */
    private $assignee;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    public function __construct(
        PullRequest $pullRequest,
        PullRequestAssignee $assignee,
        Repo $repo,
        InstallationId $installationId,
        Sender $sender
    ) {
        $this->pullRequest    = $pullRequest;
        $this->assignee       = $assignee;
        $this->repo           = $repo;
        $this->installationId = $installationId;
        $this->sender         = $sender;
    }

    public function getPullRequest(): PullRequest
    {
        return $this->pullRequest;
    }

    public function getAssignee(): PullRequestAssignee
    {
        return $this->assignee;
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
            'assignee'       => $this->assignee->serialize(),
            'repo'           => $this->repo->serialize(),
            'installationId' => $this->installationId->serialize(),
            'sender'         => $this->sender->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            PullRequest::deserialize($data['pullRequest']),
            PullRequestAssignee::deserialize($data['assignee']),
            Repo::deserialize($data['repo']),
            InstallationId::deserialize($data['installationId']),
            Sender::deserialize($data['sender'])
        );
    }
}
