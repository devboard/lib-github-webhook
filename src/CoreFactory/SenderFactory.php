<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\Generix\GravatarId;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\User\UserApiUrl;
use DevboardLib\GitHub\User\UserAvatarUrl;
use DevboardLib\GitHub\User\UserHtmlUrl;
use DevboardLib\GitHub\User\UserId;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Sender;

class SenderFactory
{
    public function create(array $data): Sender
    {
        if ('' === $data['gravatar_id']) {
            $gravatarId = null;
        } else {
            $gravatarId = new GravatarId($data['gravatar_id']);
        }

        /* @noinspection ExceptionsAnnotatingAndHandlingInspection */
        return new Sender(
            new UserId($data['id']),
            new UserLogin($data['login']),
            new AccountType($data['type']),
            new UserAvatarUrl($data['avatar_url']),
            $gravatarId,
            new UserHtmlUrl($data['html_url']),
            new UserApiUrl($data['url']),
            $data['site_admin'],
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
