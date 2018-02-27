<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\HookFactory\InstallationRepositories;

use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReference;
use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReferenceCollection;
use DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\InstallationRepositories\AddedInstallationRepositoriesEvent;
use DevboardLib\GitHubWebhook\Hook\InstallationRepositories\InstallationRepositoriesEvent;
use DevboardLib\GitHubWebhook\Hook\InstallationRepositories\RemovedInstallationRepositoriesEvent;
use DevboardLib\GitHubWebhook\HookFactory\GitHubHookEventFactory;
use Exception;

class InstallationRepositoriesEventFactory implements GitHubHookEventFactory
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
        return 'installation_repositories';
    }

    public function create(array $data): InstallationRepositoriesEvent
    {
        $installation = $this->installationFactory->create($data['installation']);
        $sender       = $this->senderFactory->create($data['sender']);

        if ('added' === $data['action']) {
            $added = new RepositoryReferenceCollection();

            foreach ($data['repositories_added'] as $item) {
                $added->add(RepositoryReference::create($item['id'], $item['full_name']));
            }

            return new AddedInstallationRepositoriesEvent($installation, $added, $sender);
        } elseif ('removed' === $data['action']) {
            $removed = new RepositoryReferenceCollection();

            foreach ($data['repositories_removed'] as $item) {
                // @TODO: for some really really strange reason, GitHub webhook can have 'null' element in repositories_removed
                if (null !== $item) {
                    $removed->add(RepositoryReference::create($item['id'], $item['full_name']));
                }
            }

            return new RemovedInstallationRepositoriesEvent($installation, $removed, $sender);
        } else {
            throw new Exception('UNSUPPORTED INSTALLATION REPOSITORY ACTION:"'.$data['action'].'"');
        }
    }
}
