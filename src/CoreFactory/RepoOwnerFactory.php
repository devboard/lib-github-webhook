<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\Generix\GravatarId;
use DevboardLib\GitHub\Account\AccountApiUrl;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountHtmlUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHubWebhook\Core\RepoOwner;

class RepoOwnerFactory
{
    public function create(array $data): RepoOwner
    {
        /* @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return new RepoOwner(
            new AccountId($data['owner']['id']),
            new AccountLogin($data['owner']['login']),
            new AccountType($data['owner']['type']),
            new AccountAvatarUrl($data['owner']['avatar_url']),
            new GravatarId($data['owner']['gravatar_id']),
            new AccountHtmlUrl($data['owner']['html_url']),
            new AccountApiUrl($data['owner']['url']),
            $data['owner']['site_admin'],
            $data['owner']['name'],
            $data['owner']['email'],
            $data['owner']['events_url'],
            $data['owner']['followers_url'],
            $data['owner']['following_url'],
            $data['owner']['gists_url'],
            $data['owner']['organizations_url'],
            $data['owner']['received_events_url'],
            $data['owner']['repos_url'],
            $data['owner']['starred_url'],
            $data['owner']['subscriptions_url']
        );
    }
}
