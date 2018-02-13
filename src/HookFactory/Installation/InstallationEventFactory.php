<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\HookFactory\Installation;

use DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\Installation\CreatedInstallationEvent;
use DevboardLib\GitHubWebhook\Hook\Installation\DeletedInstallationEvent;
use DevboardLib\GitHubWebhook\Hook\Installation\InstallationEvent;
use DevboardLib\GitHubWebhook\HookFactory\GitHubHookEventFactory;
use Exception;

/**
 * @see InstallationEventFactorySpec
 * @see InstallationEventFactoryTest
 */
class InstallationEventFactory implements GitHubHookEventFactory
{
    /** @var InstallationFactory */
    private $installationFactory;

    /** @var SenderFactory */
    private $senderFactory;

    public function __construct(InstallationFactory $installationFactory, SenderFactory $senderFactory)
    {
        $this->installationFactory = $installationFactory;
        $this->senderFactory       = $senderFactory;
    }

    public function getSupportedEventType(): string
    {
        return 'installation';
    }

    public function create(array $data): InstallationEvent
    {
        $installation = $this->installationFactory->create($data['installation']);
        $sender       = $this->senderFactory->create($data['sender']);

        if ('created' === $data['action']) {
            return new CreatedInstallationEvent($installation, $sender);
        } elseif ('deleted' === $data['action']) {
            return new DeletedInstallationEvent($installation, $sender);
        } else {
            throw new Exception('UNSUPPORTED INSTALLATION ACTION:"'.$data['action'].'"');
        }
    }
}
