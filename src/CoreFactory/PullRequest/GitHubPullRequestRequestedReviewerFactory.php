<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\PullRequest;

use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\User\UserAvatarUrl;
use DevboardLib\GitHub\User\UserId;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedReviewer;

/**
 * @see GitHubPullRequestRequestedReviewerFactorySpec
 * @see GitHubPullRequestRequestedReviewerFactoryTest
 */
class GitHubPullRequestRequestedReviewerFactory
{
    public function create(array $data): PullRequestRequestedReviewer
    {
        return new PullRequestRequestedReviewer(
            new UserId($data['id']),
            new UserLogin($data['login']),
            new AccountType($data['type']),
            new UserAvatarUrl($data['avatar_url']),
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
