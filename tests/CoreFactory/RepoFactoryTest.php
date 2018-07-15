<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\CoreFactory\RepoAdditionalDetailsFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoAdditionalUrlsFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoEndpointsFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoOwnerFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoStatsFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoTimestampsFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\RepoFactory
 */
class RepoFactoryTest extends TestCase
{
    private $sut;

    public function setUp(): void
    {
        $this->sut = self::instance();
    }

    /** @group stagingData */
    public function testRepoFactoryFromPushData(): void
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            $sender = $this->sut->create($item['repository']);

            self::assertInstanceOf(Repo::class, $sender);
        }
    }

    /** @group stagingData */
    public function testRepoFactoryFromStatusData(): void
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubStatusData() as $item) {
            $sender = $this->sut->create($item['repository']);

            self::assertInstanceOf(Repo::class, $sender);
        }
    }

    public static function instance(): RepoFactory
    {
        return new RepoFactory(
            new RepoOwnerFactory(),
            new RepoEndpointsFactory(),
            new RepoTimestampsFactory(),
            new RepoStatsFactory(),
            new RepoAdditionalDetailsFactory(),
            new RepoAdditionalUrlsFactory()
        );
    }
}
