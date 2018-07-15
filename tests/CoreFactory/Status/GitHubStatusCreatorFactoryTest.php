<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\Status;

use DevboardLib\GitHub\Status\StatusCreator;
use DevboardLib\GitHubWebhook\CoreFactory\Status\GitHubStatusCreatorFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\Status\GitHubStatusCreatorFactory
 */
class GitHubStatusCreatorFactoryTest extends TestCase
{
    private $sut;

    public function setUp(): void
    {
        $this->sut = self::instance();
    }

    /** @group stagingData */
    public function testGitHubStatusCreatorFactory(): void
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubStatusData() as $item) {
            $sender = $this->sut->create($item['sender']);

            self::assertInstanceOf(StatusCreator::class, $sender);
        }
    }

    public static function instance(): GitHubStatusCreatorFactory
    {
        return new GitHubStatusCreatorFactory();
    }
}
