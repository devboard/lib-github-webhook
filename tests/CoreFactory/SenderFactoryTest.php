<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\SenderFactory
 */
class SenderFactoryTest extends TestCase
{
    private $sut;

    public function setUp(): void
    {
        $this->sut = new SenderFactory();
    }

    /**
     * @group stagingData
     */
    public function testSenderFactory(): void
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            $sender = $this->sut->create($item['sender']);

            self::assertInstanceOf(Sender::class, $sender);
        }
    }
}
