<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\HookFactory\Push\Event;

use DevboardLib\GitHubWebhook\CoreFactory\Push\PusherFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\Push\DeleteTagPushEvent;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\DeleteTagPushEventFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\RepoFactoryTest;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\HookFactory\Push\Event\DeleteTagPushEventFactory
 */
class DeleteTagPushEventFactoryTest extends TestCase
{
    /** @var DeleteTagPushEventFactory */
    private $sut;

    public function setUp(): void
    {
        $this->sut = self::instance();
    }

    /** @group stagingData */
    public function testDeleteTagPushEventFactory(): void
    {
        self::markTestSkipped('There is no data to test this one :(');
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            if (true === $this->sut->isSatisfiedBy($item)) {
                $sender = $this->sut->create($item);

                self::assertInstanceOf(DeleteTagPushEvent::class, $sender);
            }
        }
    }

    public static function instance(): DeleteTagPushEventFactory
    {
        return new DeleteTagPushEventFactory(RepoFactoryTest::instance(), new PusherFactory(), new SenderFactory());
    }
}
