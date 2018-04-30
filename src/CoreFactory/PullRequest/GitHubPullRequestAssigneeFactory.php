<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\PullRequest;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\PullRequest\PullRequestAssignee;

/**
 * @see GitHubPullRequestAssigneeFactorySpec
 * @see GitHubPullRequestAssigneeFactoryTest
 */
class GitHubPullRequestAssigneeFactory
{
    public function create(array $data): PullRequestAssignee
    {
        return new PullRequestAssignee(
            new AccountId($data['id']),
            new AccountLogin($data['login']),
            new AccountType($data['type']),
            new AccountAvatarUrl($data['avatar_url']),
            $data['site_admin']
        );
    }
}
