<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHubWebhook\Core\RepoOwner;
use DevboardLib\GitHubWebhook\CoreFactory\RepoOwnerFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\RepoOwnerFactory
 */
class RepoOwnerFactoryTest extends TestCase
{
    private $sut;

    public function setUp()
    {
        $this->sut = new RepoOwnerFactory();
    }

    /** @group stagingData */
    public function testRepoFactoryFromPushData()
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            $sender = $this->sut->create($item['repository']['owner']);

            self::assertInstanceOf(RepoOwner::class, $sender);
        }
    }

    /** @group stagingData */
    public function testRepoFactoryFromStatusData()
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubStatusData() as $item) {
            $sender = $this->sut->create($item['repository']['owner']);

            self::assertInstanceOf(RepoOwner::class, $sender);
        }
    }
}
