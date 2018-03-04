<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\HookFactory\Push;

use DevboardLib\GitHubWebhook\Hook\Push\PushEvent;
use DevboardLib\GitHubWebhook\HookFactory\Push\PushEventFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\HookFactory\Push\Event\CreateBranchPushEventFactoryTest;
use Tests\DevboardLib\GitHubWebhook\HookFactory\Push\Event\CreateTagPushEventFactoryTest;
use Tests\DevboardLib\GitHubWebhook\HookFactory\Push\Event\DeleteBranchPushEventFactoryTest;
use Tests\DevboardLib\GitHubWebhook\HookFactory\Push\Event\DeleteTagPushEventFactoryTest;
use Tests\DevboardLib\GitHubWebhook\HookFactory\Push\Event\UpdateBranchPushEventFactoryTest;
use Tests\DevboardLib\GitHubWebhook\HookFactory\Push\Event\UpdateTagPushEventFactoryTest;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\HookFactory\Push\PushEventFactory
 */
class PushEventFactoryTest extends TestCase
{
    /** @var PushEventFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = self::instance();
    }

    /** @group stagingData */
    public function testPushEventFactory()
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            $sender = $this->sut->create($item);

            self::assertInstanceOf(PushEvent::class, $sender);
        }
    }

    public static function instance(): PushEventFactory
    {
        return new PushEventFactory(
            CreateBranchPushEventFactoryTest::instance(),
            CreateTagPushEventFactoryTest::instance(),
            UpdateBranchPushEventFactoryTest::instance(),
            UpdateTagPushEventFactoryTest::instance(),
            DeleteBranchPushEventFactoryTest::instance(),
            DeleteTagPushEventFactoryTest::instance()
        );
    }
}
