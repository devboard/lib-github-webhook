<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\Issue;

use DevboardLib\GitHub\GitHubIssue;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Hook\Issue\OpenedIssueEventSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Hook\Issue\OpenedIssueEventTest
 */
class OpenedIssueEvent implements IssueEvent
{
    /** @var GitHubIssue */
    private $issue;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    public function __construct(GitHubIssue $issue, Repo $repo, InstallationId $installationId, Sender $sender)
    {
        $this->issue          = $issue;
        $this->repo           = $repo;
        $this->installationId = $installationId;
        $this->sender         = $sender;
    }

    public function getIssue(): GitHubIssue
    {
        return $this->issue;
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
            'issue'          => $this->issue->serialize(),
            'repo'           => $this->repo->serialize(),
            'installationId' => $this->installationId->serialize(),
            'sender'         => $this->sender->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            GitHubIssue::deserialize($data['issue']),
            Repo::deserialize($data['repo']),
            InstallationId::deserialize($data['installationId']),
            Sender::deserialize($data['sender'])
        );
    }
}
