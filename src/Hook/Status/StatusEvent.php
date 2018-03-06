<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\Status;

use DevboardLib\GitHub\GitHubStatus;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Core\Status\BranchNameCollection;
use DevboardLib\GitHubWebhook\Core\Status\Commit;
use DevboardLib\GitHubWebhook\Hook\RepositoryRelatedEvent;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Hook\Status\StatusEventSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Hook\Status\StatusEventTest
 */
class StatusEvent implements RepositoryRelatedEvent
{
    /** @var GitHubStatus */
    private $status;

    /** @var Commit */
    private $commit;

    /** @var Repo */
    private $repo;

    /** @var BranchNameCollection */
    private $branches;

    /** @var Sender */
    private $sender;

    public function __construct(
        GitHubStatus $status, Commit $commit, Repo $repo, BranchNameCollection $branches, Sender $sender
    ) {
        $this->status   = $status;
        $this->commit   = $commit;
        $this->repo     = $repo;
        $this->branches = $branches;
        $this->sender   = $sender;
    }

    public function getStatus(): GitHubStatus
    {
        return $this->status;
    }

    public function getCommit(): Commit
    {
        return $this->commit;
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

    public function getBranches(): BranchNameCollection
    {
        return $this->branches;
    }

    public function getSender(): Sender
    {
        return $this->sender;
    }

    public function serialize(): array
    {
        return [
            'status'   => $this->status->serialize(),
            'commit'   => $this->commit->serialize(),
            'repo'     => $this->repo->serialize(),
            'branches' => $this->branches->serialize(),
            'sender'   => $this->sender->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            GitHubStatus::deserialize($data['status']),
            Commit::deserialize($data['commit']),
            Repo::deserialize($data['repo']),
            BranchNameCollection::deserialize($data['branches']),
            Sender::deserialize($data['sender'])
        );
    }
}
