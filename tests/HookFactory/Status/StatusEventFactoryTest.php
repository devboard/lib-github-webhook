<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\HookFactory\Status;

use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Status\CommitFactory;
use DevboardLib\GitHubWebhook\Hook\Status\StatusEvent;
use DevboardLib\GitHubWebhook\HookFactory\Status\StatusEventFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\RepoFactoryTest;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\Status\GitHubStatusFactoryTest;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\HookFactory\Status\StatusEventFactory
 */
class StatusEventFactoryTest extends TestCase
{
    /** @var StatusEventFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = self::instance();
    }

    /** @group stagingData */
    public function testStatusEventFactory()
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubStatusData() as $item) {
            $sender = $this->sut->create($item);

            self::assertInstanceOf(StatusEvent::class, $sender);
        }
    }

    public static function instance(): StatusEventFactory
    {
        return new StatusEventFactory(
            GitHubStatusFactoryTest::instance(),
            new CommitFactory(),
            RepoFactoryTest::instance(),
            new SenderFactory()
        );
    }
}
