<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\HookFactory\Installation;

use DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationAccountFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\Installation\InstallationEvent;
use DevboardLib\GitHubWebhook\HookFactory\Installation\InstallationEventFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\HookFactory\Installation\InstallationEventFactory
 */
class InstallationEventFactoryTest extends TestCase
{
    /** @var InstallationEventFactory */
    private $sut;

    public function setUp(): void
    {
        $this->sut = self::instance();
    }

    /** @group stagingData */
    public function testInstallationEventFactory(): void
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubInstalationEventData() as $item) {
            $sender = $this->sut->create($item);

            self::assertInstanceOf(InstallationEvent::class, $sender);
        }
    }

    public static function instance(): InstallationEventFactory
    {
        return new InstallationEventFactory(
            new InstallationFactory(new InstallationAccountFactory()), new SenderFactory()
        );
    }
}
