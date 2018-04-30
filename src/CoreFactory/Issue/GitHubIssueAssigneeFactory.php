<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\Issue;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\Issue\IssueAssignee;

/**
 * @see GitHubIssueAssigneeFactorySpec
 * @see GitHubIssueAssigneeFactoryTest
 */
class GitHubIssueAssigneeFactory
{
    public function create(array $data): IssueAssignee
    {
        return new IssueAssignee(
            new AccountId($data['id']),
            new AccountLogin($data['login']),
            new AccountType($data['type']),
            new AccountAvatarUrl($data['avatar_url']),
            $data['site_admin']
        );
    }
}
