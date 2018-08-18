<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\IssueComment;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueAuthor;

/**
 * @see GitHubIssueAuthorFactorySpec
 * @see GitHubIssueAuthorFactoryTest
 */
class GitHubIssueAuthorFactory
{
    public function create(array $data): IssueAuthor
    {
        return new IssueAuthor(
            new AccountId($data['id']),
            new AccountLogin($data['login']),
            new AccountType($data['type']),
            new AccountAvatarUrl($data['avatar_url']),
            $data['site_admin']
        );
    }
}
