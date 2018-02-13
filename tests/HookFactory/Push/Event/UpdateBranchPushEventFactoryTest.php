<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\HookFactory\Push\Event;

use DevboardLib\GitHubWebhook\CoreFactory\Push\CommitFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Push\PusherFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\Push\UpdateBranchPushEvent;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\UpdateBranchPushEventFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\RepoFactoryTest;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\HookFactory\Push\Event\UpdateBranchPushEventFactory
 */
class UpdateBranchPushEventFactoryTest extends TestCase
{
    /** @var UpdateBranchPushEventFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = self::instance();
    }

    /** @group stagingData */
    public function testUpdateBranchPushEventFactory()
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            if (true === $this->sut->isSatisfiedBy($item)) {
                $sender = $this->sut->create($item);

                self::assertInstanceOf(UpdateBranchPushEvent::class, $sender);
            }
        }
    }

    public static function instance(): UpdateBranchPushEventFactory
    {
        return new UpdateBranchPushEventFactory(
            new CommitFactory(), RepoFactoryTest::instance(), new PusherFactory(), new SenderFactory()
        );
    }
}
