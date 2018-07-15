<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHubWebhook\Core\RepoAdditionalUrls;
use DevboardLib\GitHubWebhook\CoreFactory\RepoAdditionalUrlsFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\RepoAdditionalUrlsFactory
 */
class RepoAdditionalUrlsFactoryTest extends TestCase
{
    private $sut;

    public function setUp(): void
    {
        $this->sut = new RepoAdditionalUrlsFactory();
    }

    /** @group stagingData */
    public function testRepoFactory(): void
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            $sender = $this->sut->create($item['repository']);

            self::assertInstanceOf(RepoAdditionalUrls::class, $sender);
        }
    }
}
