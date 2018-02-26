<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\HookFactory\InstallationRepositories;

use DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationAccountFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\InstallationRepositories\InstallationRepositoriesEvent;
use DevboardLib\GitHubWebhook\HookFactory\InstallationRepositories\InstallationRepositoriesEventFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\HookFactory\InstallationRepositories\InstallationRepositoriesEventFactory
 */
class InstallationRepositoriesEventFactoryTest extends TestCase
{
    /** @var InstallationRepositoriesEventFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = self::instance();
    }

    /** @group stagingData */
    public function testInstallationRepositoriesEventFactory()
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubInstalationRepositoriesEventData() as $item) {
            $sender = $this->sut->create($item);

            self::assertInstanceOf(InstallationRepositoriesEvent::class, $sender);
        }
    }

    public static function instance(): InstallationRepositoriesEventFactory
    {
        return new InstallationRepositoriesEventFactory(
            new InstallationFactory(new InstallationAccountFactory()), new SenderFactory()
        );
    }
}
