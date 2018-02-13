<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\Status;

use DevboardLib\GitHub\GitHubStatus;
use DevboardLib\GitHubWebhook\CoreFactory\Status\ExternalServiceFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Status\GitHubStatusCreatorFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Status\GitHubStatusFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\Status\GitHubStatusFactory
 */
class GitHubStatusFactoryTest extends TestCase
{
    private $sut;

    public function setUp()
    {
        $this->sut = self::instance();
    }

    /** @group stagingData */
    public function testGitHubStatusFactory()
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubStatusData() as $item) {
            $sender = $this->sut->create($item);

            self::assertInstanceOf(GitHubStatus::class, $sender);
        }
    }

    public static function instance(): GitHubStatusFactory
    {
        return new GitHubStatusFactory(new GitHubStatusCreatorFactory(), new ExternalServiceFactory());
    }
}