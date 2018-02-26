<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\InstallationRepositories;

use DevboardLib\GitHub\GitHubInstallation;
use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReferenceCollection;
use DevboardLib\GitHubWebhook\Core\Sender;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Hook\InstallationRepositories\AddedInstallationRepositoriesEventSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Hook\InstallationRepositories\AddedInstallationRepositoriesEventTest
 */
class AddedInstallationRepositoriesEvent implements InstallationRepositoriesEvent
{
    /** @var GitHubInstallation */
    private $installation;

    /** @var RepositoryReferenceCollection */
    private $reposAdded;

    /** @var Sender */
    private $sender;

    public function __construct(
        GitHubInstallation $installation, RepositoryReferenceCollection $reposAdded, Sender $sender
    ) {
        $this->installation = $installation;
        $this->reposAdded   = $reposAdded;
        $this->sender       = $sender;
    }

    public function getInstallation(): GitHubInstallation
    {
        return $this->installation;
    }

    public function getReposAdded(): RepositoryReferenceCollection
    {
        return $this->reposAdded;
    }

    public function getSender(): Sender
    {
        return $this->sender;
    }

    public function serialize(): array
    {
        return [
            'installation' => $this->installation->serialize(),
            'reposAdded'   => $this->reposAdded->serialize(),
            'sender'       => $this->sender->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            GitHubInstallation::deserialize($data['installation']),
            RepositoryReferenceCollection::deserialize($data['reposAdded']),
            Sender::deserialize($data['sender'])
        );
    }
}
