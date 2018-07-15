<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core\Status;

use DevboardLib\GitHubWebhook\Core\Status\CommitAuthor;

class CommitAuthorSample
{
    /** @var array */
    private static $data = [
        'octocat' => [
            'name'      => 'name',
            'email'     => 'octocat@example.com',
            'createdAt' => '2018-01-01T00:01:00+00:00',
            'details'   => [
                'userId'            => 1,
                'login'             => 'value',
                'type'              => 'User',
                'avatarUrl'         => 'avatarUrl',
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
        ],
    ];

    public static function serialized(string $item): array
    {
        return self::$data[$item];
    }

    public static function octocat(): CommitAuthor
    {
        return CommitAuthor::deserialize(self::$data['octocat']);
    }
}
