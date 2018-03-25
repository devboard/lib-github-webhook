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
use DevboardLib\GitHub\PullRequest\PullRequestAuthorAssociation;

/**
 * @see GitHubPullRequestAuthorFactorySpec
 * @see GitHubPullRequestAuthorFactoryTest
 */
class GitHubPullRequestAuthorFactory
{
    public function create(array $data, ?string $association = null): PullRequestAuthor
    {
        if (null === $association) {
            $authorAssociation = null;
        } else {
            $authorAssociation = new PullRequestAuthorAssociation($association);
        }

        return new PullRequestAuthor(
            new AccountId($data['id']),
            new AccountLogin($data['login']),
            new AccountType($data['type']),
            $authorAssociation,
            new AccountAvatarUrl($data['avatar_url']),
            new GravatarId($data['gravatar_id']),
            new AccountHtmlUrl($data['html_url']),
            new AccountApiUrl($data['url']),
            $data['site_admin']
        );
    }
}
