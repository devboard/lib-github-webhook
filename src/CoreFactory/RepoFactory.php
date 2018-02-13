<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\Git\Branch\BranchName;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Repo\RepoDescription;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoHomepage;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHub\Repo\RepoLanguage;
use DevboardLib\GitHub\Repo\RepoMirrorUrl;
use DevboardLib\GitHub\Repo\RepoName;
use DevboardLib\GitHubWebhook\Core\Repo;

/**
 * @see RepoFactorySpec
 * @see RepoFactoryTest
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class RepoFactory
{
    /** @var RepoOwnerFactory */
    private $ownerFactory;

    /** @var RepoEndpointsFactory */
    private $endpointsFactory;

    /** @var RepoTimestampsFactory */
    private $timestampsFactory;

    /** @var RepoStatsFactory */
    private $statsFactory;

    /** @var RepoAdditionalDetailsFactory */
    private $additionalDetailsFactory;

    /** @var RepoAdditionalUrlsFactory */
    private $additionalUrlsFactory;

    public function __construct(
        RepoOwnerFactory $ownerFactory,
        RepoEndpointsFactory $endpointsFactory,
        RepoTimestampsFactory $timestampsFactory,
        RepoStatsFactory $statsFactory,
        RepoAdditionalDetailsFactory $additionalDetailsFactory,
        RepoAdditionalUrlsFactory $additionalUrlsFactory
    ) {
        $this->ownerFactory             = $ownerFactory;
        $this->endpointsFactory         = $endpointsFactory;
        $this->timestampsFactory        = $timestampsFactory;
        $this->statsFactory             = $statsFactory;
        $this->additionalDetailsFactory = $additionalDetailsFactory;
        $this->additionalUrlsFactory    = $additionalUrlsFactory;
    }

    public function create(array $data): Repo
    {
        if (null !== $data['description']) {
            $description = new RepoDescription($data['description']);
        } else {
            $description = null;
        }

        $login = new AccountLogin($data['owner']['login']);

        if (null !== $data['mirror_url']) {
            $mirrorUrl = new RepoMirrorUrl($data['mirror_url']);
        } else {
            $mirrorUrl = null;
        }

        if (null !== $data['homepage']) {
            $homepage = new RepoHomepage($data['homepage']);
        } else {
            $homepage = null;
        }

        if (null !== $data['language']) {
            $language = new RepoLanguage($data['language']);
        } else {
            $language = null;
        }

        if (true === array_key_exists('archived', $data)) {
            $archived = $data['archived'];
        } else {
            $archived = null;
        }

        $repo = new Repo(
            new RepoId($data['id']),
            new RepoFullName($login, new RepoName($data['name'])),
            $this->ownerFactory->create($data),
            $data['private'],
            new BranchName($data['default_branch']),
            $data['fork'],
            null,
            // There is no parent in webhooks
            $description,
            $homepage,
            $language,
            $mirrorUrl,
            $archived,
            $this->endpointsFactory->create($data),
            $this->statsFactory->create($data),
            $this->timestampsFactory->create($data),
            $this->additionalDetailsFactory->create($data),
            $this->additionalUrlsFactory->create($data)
        );

        return $repo;
    }
}
