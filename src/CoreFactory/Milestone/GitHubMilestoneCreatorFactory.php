<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\Milestone;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\Milestone\MilestoneCreator;

/**
 * @see GitHubMilestoneCreatorFactorySpec
 * @see GitHubMilestoneCreatorFactoryTest
 */
class GitHubMilestoneCreatorFactory
{
    public function create(array $data): MilestoneCreator
    {
        return new MilestoneCreator(
            new AccountId($data['id']),
            new AccountLogin($data['login']),
            new AccountType($data['type']),
            new AccountAvatarUrl($data['avatar_url']),
            $data['site_admin']
        );
    }
}
