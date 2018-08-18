<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core\Issue;

use DevboardLib\GitHubWebhook\Core\Issue\IssueAuthor;

class IssueAuthorSample
{
    /** @var array */
    private static $data = [
        'octocat' => [
            'userId'    => 1,
            'login'     => 'octocat',
            'type'      => 'User',
            'avatarUrl' => 'avatarUrl',
            'siteAdmin' => true,
        ],
    ];

    public static function serialized(string $item): array
    {
        return self::$data[$item];
    }

    public static function octocat(): IssueAuthor
    {
        return IssueAuthor::deserialize(self::$data['octocat']);
    }
}
