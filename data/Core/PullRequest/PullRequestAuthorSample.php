<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHub\PullRequest\PullRequestAuthor;

class PullRequestAuthorSample
{
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

    public static function octocat(): PullRequestAuthor
    {
        return PullRequestAuthor::deserialize(self::$data['octocat']);
    }
}
