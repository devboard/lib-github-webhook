<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\Push;

use DevboardLib\GitHubWebhook\Core\Push\Pusher;
use DevboardLib\GitHubWebhook\CoreFactory\Push\PusherFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\Push\PusherFactory
 */
class PusherFactoryTest extends TestCase
{
    private $sut;

    public function setUp(): void
    {
        $this->sut = new PusherFactory();
    }

    /** @group stagingData */
    public function testPusherFactory(): void
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            $sender = $this->sut->create($item['pusher']);

            self::assertInstanceOf(Pusher::class, $sender);
        }
    }
}
