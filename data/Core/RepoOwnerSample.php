<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\RepoOwner;

class RepoOwnerSample
{
    /** @var array */
    private static $data = [
        'octocat' => [
            'userId'            => 1,
            'login'             => 'octocat',
            'type'              => 'User',
            'avatarUrl'         => 'avatarUrl',
            'siteAdmin'         => true,
            'name'              => 'octocat',
            'email'             => 'octocat@example.com',
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

    public static function octocat(): RepoOwner
    {
        return RepoOwner::deserialize(self::$data['octocat']);
    }
}
