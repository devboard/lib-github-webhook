<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHubWebhook\Core\RepoAdditionalDetails;
use DevboardLib\GitHubWebhook\CoreFactory\RepoAdditionalDetailsFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\RepoAdditionalDetailsFactory
 */
class RepoAdditionalDetailsFactoryTest extends TestCase
{
    private $sut;

    public function setUp(): void
    {
        $this->sut = new RepoAdditionalDetailsFactory();
    }

    /** @group stagingData */
    public function testRepoAdditionalDetailsFactory(): void
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            $sender = $this->sut->create($item['repository']);

            self::assertInstanceOf(RepoAdditionalDetails::class, $sender);
        }
    }
}
