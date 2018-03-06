<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\IssueComment;

use DevboardLib\GitHub\GitHubIssue;
use DevboardLib\GitHub\GitHubIssueComment;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Hook\IssueComment\EditedIssueCommentEventSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Hook\IssueComment\EditedIssueCommentEventTest
 */
class EditedIssueCommentEvent implements IssueCommentEvent
{
    /** @var GitHubIssueComment */
    private $comment;

    /** @var GitHubIssue */
    private $issue;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    public function __construct(
        GitHubIssueComment $comment, GitHubIssue $issue, Repo $repo, InstallationId $installationId, Sender $sender
    ) {
        $this->comment        = $comment;
        $this->issue          = $issue;
        $this->repo           = $repo;
        $this->installationId = $installationId;
        $this->sender         = $sender;
    }

    public function getComment(): GitHubIssueComment
    {
        return $this->comment;
    }

    public function getIssue(): GitHubIssue
    {
        return $this->issue;
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
            'comment'        => $this->comment->serialize(),
            'issue'          => $this->issue->serialize(),
            'repo'           => $this->repo->serialize(),
            'installationId' => $this->installationId->serialize(),
            'sender'         => $this->sender->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            GitHubIssueComment::deserialize($data['comment']),
            GitHubIssue::deserialize($data['issue']),
            Repo::deserialize($data['repo']),
            InstallationId::deserialize($data['installationId']),
            Sender::deserialize($data['sender'])
        );
    }
}
