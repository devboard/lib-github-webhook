<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\Issue;

use DevboardLib\Generix\GravatarId;
use DevboardLib\GitHub\Account\AccountApiUrl;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountHtmlUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\Issue\IssueAuthor;

/**
 * @see GitHubIssueAuthorFactorySpec
 * @see GitHubIssueAuthorFactoryTest
 */
class GitHubIssueAuthorFactory
{
    public function create(array $data): IssueAuthor
    {
        if ('' === $data['gravatar_id']) {
            $gravatarId = null;
        } else {
            $gravatarId = new GravatarId($data['gravatar_id']);
        }

        return new IssueAuthor(
            new AccountId($data['id']),
            new AccountLogin($data['login']),
            new AccountType($data['type']),
            new AccountAvatarUrl($data['avatar_url']),
            $gravatarId,
            new AccountHtmlUrl($data['html_url']),
            new AccountApiUrl($data['url']),
            $data['site_admin']
        );
    }
}
