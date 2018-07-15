<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHub\Repo\RepoEndpoints;
use DevboardLib\GitHubWebhook\CoreFactory\RepoEndpointsFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\RepoEndpointsFactory
 */
class RepoEndpointsFactoryTest extends TestCase
{
    private $sut;

    public function setUp(): void
    {
        $this->sut = new RepoEndpointsFactory();
    }

    /** @group stagingData */
    public function testRepoFactory(): void
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            $sender = $this->sut->create($item['repository']);

            self::assertInstanceOf(RepoEndpoints::class, $sender);
        }
    }
}
