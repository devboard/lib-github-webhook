<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\HookFactory\Push\Event;

use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHubWebhook\Core\Push\Ref;
use DevboardLib\GitHubWebhook\CoreFactory\Push\PusherFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\Push\DeleteTagPushEvent;

class DeleteTagPushEventFactory
{
    /** @var RepoFactory */
    private $repoFactory;

    /** @var PusherFactory */
    private $pusherFactory;

    /** @var SenderFactory */
    private $senderFactory;

    public function __construct(RepoFactory $repoFactory, PusherFactory $pusherFactory, SenderFactory $senderFactory)
    {
        $this->repoFactory   = $repoFactory;
        $this->pusherFactory = $pusherFactory;
        $this->senderFactory = $senderFactory;
    }

    public function isSatisfiedBy(array $data): bool
    {
        if (true !== $data['deleted']) {
            return false;
        }

        $ref = new Ref($data['ref']);

        if (false === $ref->isTagReference()) {
            return false;
        }

        return true;
    }

    public function create(array $data)
    {
        return new DeleteTagPushEvent(
            new Ref($data['ref']),
            new CommitSha($data['before']),
            $this->repoFactory->create($data['repository']),
            $data['forced'],
            $this->pusherFactory->create($data['pusher']),
            $this->senderFactory->create($data['sender'])
        );
    }
}
