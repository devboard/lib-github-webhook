<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewAuthor;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewAuthorAssociation;

/**
 * @see GitHubPullRequestReviewAuthorFactorySpec
 * @see GitHubPullRequestReviewAuthorFactoryTest
 */
class GitHubPullRequestReviewAuthorFactory
{
    public function create(array $data, ?string $association = null): PullRequestReviewAuthor
    {
        if (null === $association) {
            $authorAssociation = null;
        } else {
            $authorAssociation = new PullRequestReviewAuthorAssociation($association);
        }

        return new PullRequestReviewAuthor(
            new AccountId($data['id']),
            new AccountLogin($data['login']),
            new AccountType($data['type']),
            $authorAssociation,
            new AccountAvatarUrl($data['avatar_url']),
            $data['site_admin']
        );
    }
}
