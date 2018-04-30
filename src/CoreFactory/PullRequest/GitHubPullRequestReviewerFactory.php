<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\PullRequest;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\PullRequest\PullRequestReviewer;

/**
 * @see GitHubPullRequestReviewerFactorySpec
 * @see GitHubPullRequestReviewerFactoryTest
 */
class GitHubPullRequestReviewerFactory
{
    public function create(array $data): PullRequestReviewer
    {
        return new PullRequestReviewer(
            new AccountId($data['id']),
            new AccountLogin($data['login']),
            new AccountType($data['type']),
            new AccountAvatarUrl($data['avatar_url']),
            $data['site_admin']
        );
    }
}
