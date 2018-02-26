<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\InstallationRepositories;

use DevboardLib\GitHub\GitHubInstallation;
use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReferenceCollection;
use DevboardLib\GitHubWebhook\Core\Sender;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Hook\InstallationRepositories\RemovedInstallationRepositoriesEventSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Hook\InstallationRepositories\RemovedInstallationRepositoriesEventTest
 */
class RemovedInstallationRepositoriesEvent implements InstallationRepositoriesEvent
{
    /** @var GitHubInstallation */
    private $installation;

    /** @var RepositoryReferenceCollection */
    private $reposRemoved;

    /** @var Sender */
    private $sender;

    public function __construct(
        GitHubInstallation $installation, RepositoryReferenceCollection $reposRemoved, Sender $sender
    ) {
        $this->installation = $installation;
        $this->reposRemoved = $reposRemoved;
        $this->sender       = $sender;
    }

    public function getInstallation(): GitHubInstallation
    {
        return $this->installation;
    }

    public function getReposRemoved(): RepositoryReferenceCollection
    {
        return $this->reposRemoved;
    }

    public function getSender(): Sender
    {
        return $this->sender;
    }

    public function serialize(): array
    {
        return [
            'installation' => $this->installation->serialize(),
            'reposRemoved' => $this->reposRemoved->serialize(),
            'sender'       => $this->sender->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            GitHubInstallation::deserialize($data['installation']),
            RepositoryReferenceCollection::deserialize($data['reposRemoved']),
            Sender::deserialize($data['sender'])
        );
    }
}
