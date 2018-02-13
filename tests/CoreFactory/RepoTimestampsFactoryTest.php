<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHub\Repo\RepoTimestamps;
use DevboardLib\GitHubWebhook\CoreFactory\RepoTimestampsFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\RepoTimestampsFactory
 */
class RepoTimestampsFactoryTest extends TestCase
{
    private $sut;

    public function setUp()
    {
        $this->sut = new RepoTimestampsFactory();
    }

    /** @group stagingData */
    public function testRepoFactory()
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            $sender = $this->sut->create($item['repository']);

            self::assertInstanceOf(RepoTimestamps::class, $sender);
        }
    }
}
