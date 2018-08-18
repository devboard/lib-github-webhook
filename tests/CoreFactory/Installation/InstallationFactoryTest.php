<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\Installation;

use DevboardLib\GitHubWebhook\Core\Installation\InstallationDetails;
use DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationAccountFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationFactory
 */
class InstallationFactoryTest extends TestCase
{
    private $sut;

    public function setUp(): void
    {
        $this->sut = new InstallationFactory(new InstallationAccountFactory());
    }

    /** @group stagingData */
    public function testInstallationFactory(): void
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubInstalationEventData() as $item) {
            $sender = $this->sut->create($item['installation']);

            self::assertInstanceOf(InstallationDetails::class, $sender);
        }
    }
}
