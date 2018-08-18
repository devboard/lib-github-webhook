<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\HookFactory\Push\Event;

use DevboardLib\GitHubWebhook\CoreFactory\Push\CommitFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Push\PusherFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\Push\UpdateTagPushEvent;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\UpdateTagPushEventFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\RepoFactoryTest;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\HookFactory\Push\Event\UpdateTagPushEventFactory
 */
class UpdateTagPushEventFactoryTest extends TestCase
{
    /** @var UpdateTagPushEventFactory */
    private $sut;

    public function setUp(): void
    {
        $this->sut = self::instance();
    }

    /** @group stagingData */
    public function testUpdateTagPushEventFactory(): void
    {
        self::markTestSkipped('There is no data to test this one :(');

        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            if (true === $this->sut->isSatisfiedBy($item)) {
                $sender = $this->sut->create($item);

                self::assertInstanceOf(UpdateTagPushEvent::class, $sender);
            }
        }
    }

    public static function instance(): UpdateTagPushEventFactory
    {
        return new UpdateTagPushEventFactory(
            new CommitFactory(), RepoFactoryTest::instance(), new PusherFactory(), new SenderFactory()
        );
    }
}
