<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\HookFactory\Push\Event;

use DevboardLib\GitHubWebhook\CoreFactory\Push\CommitFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Push\PusherFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\Push\CreateBranchPushEvent;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\CreateBranchPushEventFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\RepoFactoryTest;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\HookFactory\Push\Event\CreateBranchPushEventFactory
 */
class CreateBranchPushEventFactoryTest extends TestCase
{
    /** @var CreateBranchPushEventFactory */
    private $sut;

    public function setUp(): void
    {
        $this->sut = self::instance();
    }

    /** @group stagingData */
    public function testCreateBranchPushEventFactory(): void
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            if (true === $this->sut->isSatisfiedBy($item)) {
                $sender = $this->sut->create($item);

                self::assertInstanceOf(CreateBranchPushEvent::class, $sender);
            }
        }
    }

    public static function instance(): CreateBranchPushEventFactory
    {
        return new CreateBranchPushEventFactory(
            new CommitFactory(), RepoFactoryTest::instance(), new PusherFactory(), new SenderFactory()
        );
    }
}
