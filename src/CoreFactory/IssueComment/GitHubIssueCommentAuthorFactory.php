<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\IssueComment;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\IssueComment\IssueCommentAuthor;

/**
 * @see GitHubIssueCommentAuthorFactorySpec
 * @see GitHubIssueCommentAuthorFactoryTest
 */
class GitHubIssueCommentAuthorFactory
{
    public function create(array $data): IssueCommentAuthor
    {
        return new IssueCommentAuthor(
            new AccountId($data['id']),
            new AccountLogin($data['login']),
            new AccountType($data['type']),
            new AccountAvatarUrl($data['avatar_url']),
            $data['site_admin']
        );
    }
}
