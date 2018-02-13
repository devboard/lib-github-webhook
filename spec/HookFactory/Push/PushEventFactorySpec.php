<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\HookFactory\Push;

use DevboardLib\GitHubWebhook\HookFactory\Push\Event\CreateBranchPushEventFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\CreateTagPushEventFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\DeleteBranchPushEventFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\DeleteTagPushEventFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\UpdateBranchPushEventFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\UpdateTagPushEventFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\PushEventFactory;
use PhpSpec\ObjectBehavior;

class PushEventFactorySpec extends ObjectBehavior
{
    public function let(
        CreateBranchPushEventFactory $createBranchPushEventFactory,
        CreateTagPushEventFactory $createTagPushEventFactory,
        UpdateBranchPushEventFactory $updateBranchPushEventFactory,
        UpdateTagPushEventFactory $updateTagPushEventFactory,
        DeleteBranchPushEventFactory $deleteBranchPushEventFactory,
        DeleteTagPushEventFactory $deleteTagPushEventFactory
    ) {
        $this->beConstructedWith(
            $createBranchPushEventFactory,
            $createTagPushEventFactory,
            $updateBranchPushEventFactory,
            $updateTagPushEventFactory,
            $deleteBranchPushEventFactory,
            $deleteTagPushEventFactory
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PushEventFactory::class);
    }
}
