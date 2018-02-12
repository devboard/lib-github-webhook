<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\Push;

use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHubWebhook\Core\Push\Ref;
use DevboardLib\GitHubWebhook\Core\Pusher;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\PushEvent;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Hook\Push\DeleteBranchPushEventSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Hook\Push\DeleteBranchPushEventTest
 */
class DeleteBranchPushEvent implements PushEvent
{
    /** @var Ref */
    private $ref;

    /** @var CommitSha */
    private $before;

    /** @var Repo */
    private $repo;

    /** @var bool */
    private $forced;

    /** @var Pusher */
    private $pusher;

    /** @var Sender */
    private $sender;

    public function __construct(Ref $ref, CommitSha $before, Repo $repo, bool $forced, Pusher $pusher, Sender $sender)
    {
        $this->ref    = $ref;
        $this->before = $before;
        $this->repo   = $repo;
        $this->forced = $forced;
        $this->pusher = $pusher;
        $this->sender = $sender;
    }

    public function getRef(): Ref
    {
        return $this->ref;
    }

    public function getBefore(): CommitSha
    {
        return $this->before;
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

    public function serialize(): array
    {
        return [
            'ref'    => $this->ref->serialize(),
            'before' => $this->before->serialize(),
            'repo'   => $this->repo->serialize(),
            'forced' => $this->forced,
            'pusher' => $this->pusher->serialize(),
            'sender' => $this->sender->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            Ref::deserialize($data['ref']),
            CommitSha::deserialize($data['before']),
            Repo::deserialize($data['repo']),
            $data['forced'],
            Pusher::deserialize($data['pusher']),
            Sender::deserialize($data['sender'])
        );
    }
}
