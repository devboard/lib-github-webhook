<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\Push;

use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHubWebhook\Core\Push\Commit;
use DevboardLib\GitHubWebhook\Core\Push\CommitCollection;
use DevboardLib\GitHubWebhook\Core\Push\CompareChangesUrl;
use DevboardLib\GitHubWebhook\Core\Push\Pusher;
use DevboardLib\GitHubWebhook\Core\Push\Ref;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Hook\Push\CreateBranchPushEventSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Hook\Push\CreateBranchPushEventTest
 */
class CreateBranchPushEvent implements PushEvent
{
    /** @var Ref */
    private $ref;

    /** @var CommitSha */
    private $after;

    /** @var Ref|null */
    private $baseRef;

    /** @var CompareChangesUrl */
    private $changesUrl;

    /** @var CommitCollection */
    private $commits;

    /** @var Commit */
    private $headCommit;

    /** @var Repo */
    private $repo;

    /** @var bool */
    private $forced;

    /** @var Pusher */
    private $pusher;

    /** @var Sender */
    private $sender;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        Ref $ref,
        CommitSha $after,
        ?Ref $baseRef,
        CompareChangesUrl $changesUrl,
        CommitCollection $commits,
        Commit $headCommit,
        Repo $repo,
        bool $forced,
        Pusher $pusher,
        Sender $sender
    ) {
        $this->ref        = $ref;
        $this->after      = $after;
        $this->baseRef    = $baseRef;
        $this->changesUrl = $changesUrl;
        $this->commits    = $commits;
        $this->headCommit = $headCommit;
        $this->repo       = $repo;
        $this->forced     = $forced;
        $this->pusher     = $pusher;
        $this->sender     = $sender;
    }

    public function getRef(): Ref
    {
        return $this->ref;
    }

    public function getAfter(): CommitSha
    {
        return $this->after;
    }

    public function getBaseRef(): ?Ref
    {
        return $this->baseRef;
    }

    public function getChangesUrl(): CompareChangesUrl
    {
        return $this->changesUrl;
    }

    public function getCommits(): CommitCollection
    {
        return $this->commits;
    }

    public function getHeadCommit(): Commit
    {
        return $this->headCommit;
    }

    public function getRepo(): Repo
    {
        return $this->repo;
    }

    public function isForced(): bool
    {
        return $this->forced;
    }

    public function getPusher(): Pusher
    {
        return $this->pusher;
    }

    public function getSender(): Sender
    {
        return $this->sender;
    }

    public function hasBaseRef(): bool
    {
        if (null === $this->baseRef) {
            return false;
        }

        return true;
    }

    public function serialize(): array
    {
        if (null === $this->baseRef) {
            $baseRef = null;
        } else {
            $baseRef = $this->baseRef->serialize();
        }

        return [
            'ref'        => $this->ref->serialize(),
            'after'      => $this->after->serialize(),
            'baseRef'    => $baseRef,
            'changesUrl' => $this->changesUrl->serialize(),
            'commits'    => $this->commits->serialize(),
            'headCommit' => $this->headCommit->serialize(),
            'repo'       => $this->repo->serialize(),
            'forced'     => $this->forced,
            'pusher'     => $this->pusher->serialize(),
            'sender'     => $this->sender->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        if (null === $data['baseRef']) {
            $baseRef = null;
        } else {
            $baseRef = Ref::deserialize($data['baseRef']);
        }

        return new self(
            Ref::deserialize($data['ref']),
            CommitSha::deserialize($data['after']),
            $baseRef,
            CompareChangesUrl::deserialize($data['changesUrl']),
            CommitCollection::deserialize($data['commits']),
            Commit::deserialize($data['headCommit']),
            Repo::deserialize($data['repo']),
            $data['forced'],
            Pusher::deserialize($data['pusher']),
            Sender::deserialize($data['sender'])
        );
    }
}
