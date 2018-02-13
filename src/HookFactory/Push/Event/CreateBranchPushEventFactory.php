<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\HookFactory\Push\Event;

use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHubWebhook\Core\Push\CommitCollection;
use DevboardLib\GitHubWebhook\Core\Push\CompareChangesUrl;
use DevboardLib\GitHubWebhook\Core\Push\Ref;
use DevboardLib\GitHubWebhook\CoreFactory\Push\CommitFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Push\PusherFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\Push\CreateBranchPushEvent;

/**
 * @see \spec\DevboardLib\GitHubWebhook\HookFactory\Push\Event\CreateBranchPushEventFactorySpec
 * @see \Tests\DevboardLib\GitHubWebhook\HookFactory\Push\Event\CreateBranchPushEventFactoryTest
 */
class CreateBranchPushEventFactory implements BasePushFactory
{
    /** @var CommitFactory */
    private $commitFactory;

    /** @var RepoFactory */
    private $repoFactory;

    /** @var PusherFactory */
    private $pusherFactory;

    /** @var SenderFactory */
    private $senderFactory;

    public function __construct(
        CommitFactory $commitFactory,
        RepoFactory $repoFactory,
        PusherFactory $pusherFactory,
        SenderFactory $senderFactory
    ) {
        $this->commitFactory = $commitFactory;
        $this->repoFactory   = $repoFactory;
        $this->pusherFactory = $pusherFactory;
        $this->senderFactory = $senderFactory;
    }

    public function isSatisfiedBy(array $data): bool
    {
        if (true !== $data['created']) {
            return false;
        }

        $ref = new Ref($data['ref']);

        if (false === $ref->isBranchReference()) {
            return false;
        }

        return true;
    }

    public function create(array $data): CreateBranchPushEvent
    {
        if (null !== $data['base_ref']) {
            $baseRef = new Ref($data['base_ref']);
        } else {
            $baseRef = null;
        }

        return new CreateBranchPushEvent(
            new Ref($data['ref']),
            new CommitSha($data['before']),
            $baseRef,
            new CompareChangesUrl($data['compare']),
            new CommitCollection(),
            $this->commitFactory->create($data['head_commit']),
            $this->repoFactory->create($data['repository']),
            $data['forced'],
            $this->pusherFactory->create($data['pusher']),
            $this->senderFactory->create($data['sender'])
        );
    }
}
