<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\PullRequest;

use DevboardLib\Generix\GravatarId;
use DevboardLib\GitHub\Account\AccountApiUrl;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountHtmlUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\PullRequest\PullRequestAuthor;

/**
 * @see GitHubPullRequestAuthorFactorySpec
 * @see GitHubPullRequestAuthorFactoryTest
 */
class GitHubPullRequestAuthorFactory
{
    public function create(array $data): PullRequestAuthor
    {
        return new PullRequestAuthor(
            new AccountId($data['id']),
            new AccountLogin($data['login']),
            new AccountType($data['type']),
            new AccountAvatarUrl($data['avatar_url']),
            new GravatarId($data['gravatar_id']),
            new AccountHtmlUrl($data['html_url']),
            new AccountApiUrl($data['url']),
            $data['site_admin']
        );
    }
}
