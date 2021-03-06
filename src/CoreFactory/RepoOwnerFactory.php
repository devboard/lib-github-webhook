<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHubWebhook\Core\RepoOwner;

class RepoOwnerFactory
{
    public function create(array $data): RepoOwner
    {
        if (true === array_key_exists('name', $data)) {
            $name = $data['name'];
        } else {
            $name = null;
        }
        if (true === array_key_exists('email', $data)) {
            $email = $data['email'];
        } else {
            $email = null;
        }

        /* @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return new RepoOwner(
            new AccountId($data['id']),
            new AccountLogin($data['login']),
            new AccountType($data['type']),
            new AccountAvatarUrl($data['avatar_url']),
            $data['site_admin'],
            $name,
            $email,
            $data['events_url'],
            $data['followers_url'],
            $data['following_url'],
            $data['gists_url'],
            $data['organizations_url'],
            $data['received_events_url'],
            $data['repos_url'],
            $data['starred_url'],
            $data['subscriptions_url']
        );
    }
}
