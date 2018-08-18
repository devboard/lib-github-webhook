<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Installation;

use DevboardLib\GitHub\Application\ApplicationId;
use DevboardLib\GitHub\Installation\InstallationAccessTokenUrl;
use DevboardLib\GitHub\Installation\InstallationAccount;
use DevboardLib\GitHub\Installation\InstallationCreatedAt;
use DevboardLib\GitHub\Installation\InstallationEvents;
use DevboardLib\GitHub\Installation\InstallationHtmlUrl;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHub\Installation\InstallationPermissions;
use DevboardLib\GitHub\Installation\InstallationRepositoriesUrl;
use DevboardLib\GitHub\Installation\InstallationRepositorySelection;
use DevboardLib\GitHub\Installation\InstallationRepositorySelectionFactory;
use DevboardLib\GitHub\Installation\InstallationUpdatedAt;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 *
 * @see \spec\DevboardLib\GitHubWebhook\Core\Installation\InstallationDetailsSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\Installation\InstallationDetailsTest
 */
class InstallationDetails
{
    /** @var InstallationId */
    private $installationId;

    /** @var InstallationAccount */
    private $installationAccount;

    /** @var ApplicationId */
    private $applicationId;

    /** @var InstallationRepositorySelection|null */
    private $repositorySelection;

    /** @var InstallationPermissions */
    private $permissions;

    /** @var InstallationEvents */
    private $events;

    /** @var InstallationAccessTokenUrl */
    private $accessTokenUrl;

    /** @var InstallationRepositoriesUrl */
    private $repositoriesUrl;

    /** @var InstallationHtmlUrl */
    private $htmlUrl;

    /** @var InstallationCreatedAt */
    private $createdAt;

    /** @var InstallationUpdatedAt */
    private $updatedAt;

    public function __construct(
        InstallationId $installationId,
        InstallationAccount $installationAccount,
        ApplicationId $applicationId,
        ?InstallationRepositorySelection $repositorySelection,
        InstallationPermissions $permissions,
        InstallationEvents $events,
        InstallationAccessTokenUrl $accessTokenUrl,
        InstallationRepositoriesUrl $repositoriesUrl,
        InstallationHtmlUrl $htmlUrl,
        InstallationCreatedAt $createdAt,
        InstallationUpdatedAt $updatedAt
    ) {
        $this->installationId      = $installationId;
        $this->installationAccount = $installationAccount;
        $this->applicationId       = $applicationId;
        $this->repositorySelection = $repositorySelection;
        $this->permissions         = $permissions;
        $this->events              = $events;
        $this->accessTokenUrl      = $accessTokenUrl;
        $this->repositoriesUrl     = $repositoriesUrl;
        $this->htmlUrl             = $htmlUrl;
        $this->createdAt           = $createdAt;
        $this->updatedAt           = $updatedAt;
    }

    public function getInstallationId(): InstallationId
    {
        return $this->installationId;
    }

    public function getInstallationAccount(): InstallationAccount
    {
        return $this->installationAccount;
    }

    public function getApplicationId(): ApplicationId
    {
        return $this->applicationId;
    }

    public function getRepositorySelection(): ?InstallationRepositorySelection
    {
        return $this->repositorySelection;
    }

    public function getPermissions(): InstallationPermissions
    {
        return $this->permissions;
    }

    public function getEvents(): InstallationEvents
    {
        return $this->events;
    }

    public function getAccessTokenUrl(): InstallationAccessTokenUrl
    {
        return $this->accessTokenUrl;
    }

    public function getRepositoriesUrl(): InstallationRepositoriesUrl
    {
        return $this->repositoriesUrl;
    }

    public function getHtmlUrl(): InstallationHtmlUrl
    {
        return $this->htmlUrl;
    }

    public function getCreatedAt(): InstallationCreatedAt
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): InstallationUpdatedAt
    {
        return $this->updatedAt;
    }

    public function hasRepositorySelection(): bool
    {
        if (null === $this->repositorySelection) {
            return false;
        }

        return true;
    }

    public function serialize(): array
    {
        if (null === $this->repositorySelection) {
            $repositorySelection = null;
        } else {
            $repositorySelection = $this->repositorySelection->serialize();
        }

        return [
            'installationId'      => $this->installationId->serialize(),
            'installationAccount' => $this->installationAccount->serialize(),
            'applicationId'       => $this->applicationId->serialize(),
            'repositorySelection' => $repositorySelection,
            'permissions'         => $this->permissions->serialize(),
            'events'              => $this->events->serialize(),
            'accessTokenUrl'      => $this->accessTokenUrl->serialize(),
            'repositoriesUrl'     => $this->repositoriesUrl->serialize(),
            'htmlUrl'             => $this->htmlUrl->serialize(),
            'createdAt'           => $this->createdAt->serialize(),
            'updatedAt'           => $this->updatedAt->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        if (null === $data['repositorySelection']) {
            $repositorySelection = null;
        } else {
            $repositorySelection = InstallationRepositorySelectionFactory::create($data['repositorySelection']);
        }

        return new self(
            InstallationId::deserialize($data['installationId']),
            InstallationAccount::deserialize($data['installationAccount']),
            ApplicationId::deserialize($data['applicationId']),
            $repositorySelection,
            InstallationPermissions::deserialize($data['permissions']),
            InstallationEvents::deserialize($data['events']),
            InstallationAccessTokenUrl::deserialize($data['accessTokenUrl']),
            InstallationRepositoriesUrl::deserialize($data['repositoriesUrl']),
            InstallationHtmlUrl::deserialize($data['htmlUrl']),
            InstallationCreatedAt::deserialize($data['createdAt']),
            InstallationUpdatedAt::deserialize($data['updatedAt'])
        );
    }
}
