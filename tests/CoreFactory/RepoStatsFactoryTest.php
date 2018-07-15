<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHub\Repo\RepoStats;
use DevboardLib\GitHubWebhook\CoreFactory\RepoStatsFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\RepoStatsFactory
 */
class RepoStatsFactoryTest extends TestCase
{
    private $sut;

    public function setUp(): void
    {
        $this->sut = new RepoStatsFactory();
    }

    /** @group stagingData */
    public function testRepoFactory(): void
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            $sender = $this->sut->create($item['repository']);

            self::assertInstanceOf(RepoStats::class, $sender);
        }
    }
}
