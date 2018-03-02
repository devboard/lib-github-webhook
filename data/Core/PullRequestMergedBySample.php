<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestMergedBy;

class PullRequestMergedBySample
{
    private static $data = [
        'octocat' => [
            'userId'            => 1,
            'login'             => 'octocat',
            'type'              => 'User',
            'avatarUrl'         => 'avatarUrl',
            'gravatarId'        => 'id',
            'htmlUrl'           => 'htmlUrl',
            'apiUrl'            => 'apiUrl',
            'siteAdmin'         => true,
            'eventsUrl'         => 'eventsUrl',
            'followersUrl'      => 'followersUrl',
            'followingUrl'      => 'followingUrl',
            'gistsUrl'          => 'gistsUrl',
            'organizationsUrl'  => 'organizationsUrl',
            'receivedEventsUrl' => 'receivedEventsUrl',
            'reposUrl'          => 'reposUrl',
            'starredUrl'        => 'starredUrl',
            'subscriptionsUrl'  => 'subscriptionsUrl',
        ],
    ];

    public static function serialized(string $item): array
    {
        return self::$data[$item];
    }

    public static function octocat(): PullRequestMergedBy
    {
        return PullRequestMergedBy::deserialize(self::$data['octocat']);
    }
}
