<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\HookFactory\Push;

use DevboardLib\GitHubWebhook\Hook\PushEvent;
use DevboardLib\GitHubWebhook\HookFactory\GitHubHookEventFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\BasePushFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\CreateBranchPushEventFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\CreateTagPushEventFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\DeleteBranchPushEventFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\DeleteTagPushEventFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\UpdateBranchPushEventFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\UpdateTagPushEventFactory;

/**
 * @see PushEventFactorySpec
 * @see PushEventFactoryTest
 */
class PushEventFactory implements GitHubHookEventFactory
{
    /** @var array|BasePushFactory[] */
    private $factories = [];

    public function __construct(
        CreateBranchPushEventFactory $createBranchPushEventFactory,
        CreateTagPushEventFactory $createTagPushEventFactory,
        UpdateBranchPushEventFactory $updateBranchPushEventFactory,
        UpdateTagPushEventFactory $updateTagPushEventFactory,
        DeleteBranchPushEventFactory $deleteBranchPushEventFactory,
        DeleteTagPushEventFactory $deleteTagPushEventFactory
    ) {
        $this->factories = [
            $createBranchPushEventFactory,
            $createTagPushEventFactory,
            $updateBranchPushEventFactory,
            $updateTagPushEventFactory,
            $deleteBranchPushEventFactory,
            $deleteTagPushEventFactory,
        ];
    }

    public function getSupportedEventType(): string
    {
        return 'push';
    }

    public function create(array $data): PushEvent
    {
        foreach ($this->factories as $factory) {
            if (true === $factory->isSatisfiedBy($data)) {
                return $factory->create($data);
            }
        }

        throw UnmatchedPushEventException::create($data);
    }
}
