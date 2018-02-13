<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\HookFactory\Push\Event;

use DevboardLib\GitHubWebhook\CoreFactory\Push\PusherFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\Push\DeleteBranchPushEvent;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\DeleteBranchPushEventFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\RepoFactoryTest;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\HookFactory\Push\Event\DeleteBranchPushEventFactory
 */
class DeleteBranchPushEventFactoryTest extends TestCase
{
    /** @var DeleteBranchPushEventFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = self::instance();
    }

    /** @group stagingData */
    public function testDeleteBranchPushEventFactory()
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            if (true === $this->sut->isSatisfiedBy($item)) {
                $sender = $this->sut->create($item);

                self::assertInstanceOf(DeleteBranchPushEvent::class, $sender);
            }
        }
    }

    public static function instance(): DeleteBranchPushEventFactory
    {
        return new DeleteBranchPushEventFactory(
            RepoFactoryTest::instance(), new PusherFactory(), new SenderFactory()
        );
    }
}
