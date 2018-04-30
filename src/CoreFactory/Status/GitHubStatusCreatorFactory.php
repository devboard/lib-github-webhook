<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\Status;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\Status\StatusCreator;

class GitHubStatusCreatorFactory
{
    public function create(array $data): StatusCreator
    {
        return new StatusCreator(
            new AccountId($data['id']),
            new AccountLogin($data['login']),
            new AccountType($data['type']),
            new AccountAvatarUrl($data['avatar_url']),
            $data['site_admin']
        );
    }
}
