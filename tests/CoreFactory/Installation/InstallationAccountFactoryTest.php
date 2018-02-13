<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\Installation;

use DevboardLib\GitHub\Installation\InstallationAccount;
use DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationAccountFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationAccountFactory
 */
class InstallationAccountFactoryTest extends TestCase
{
    private $sut;

    public function setUp()
    {
        $this->sut = new InstallationAccountFactory();
    }

    /** @group stagingData */
    public function testInstallationAccountFactory()
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubInstalationEventData() as $item) {
            $sender = $this->sut->create($item['installation']['account']);

            self::assertInstanceOf(InstallationAccount::class, $sender);
        }
    }
}
