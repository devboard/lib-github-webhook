<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\Status;

use DevboardLib\GitHub\External\ExternalService;
use DevboardLib\GitHub\Status\StatusContext;
use DevboardLib\GitHubWebhook\CoreFactory\Status\ExternalServiceFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\Status\ExternalServiceFactory
 */
class ExternalServiceFactoryTest extends TestCase
{
    private $sut;

    public function setUp()
    {
        $this->sut = self::instance();
    }

    /** @group stagingData */
    public function testExternalServiceFactory()
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubStatusData() as $item) {
            $sender = $this->sut->create(new StatusContext($item['context']));

            self::assertInstanceOf(ExternalService::class, $sender);
        }
    }

    public static function instance(): ExternalServiceFactory
    {
        return new ExternalServiceFactory();
    }
}
