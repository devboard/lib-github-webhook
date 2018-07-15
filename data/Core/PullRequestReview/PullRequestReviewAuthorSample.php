<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core\PullRequestReview;

use DevboardLib\GitHub\PullRequestReview\PullRequestReviewAuthor;

class PullRequestReviewAuthorSample
{
    /** @var array */
    private static $data = [
        'octocat' => [
            'userId'      => 1,
            'login'       => 'octocat',
            'type'        => 'User',
            'association' => 'COLLABORATOR',
            'avatarUrl'   => 'avatarUrl',
            'siteAdmin'   => true,
        ],
    ];

    public static function serialized(string $item): array
    {
        return self::$data[$item];
    }

    public static function octocat(): PullRequestReviewAuthor
    {
        return PullRequestReviewAuthor::deserialize(self::$data['octocat']);
    }
}
