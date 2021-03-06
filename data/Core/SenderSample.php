<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\Sender;

class SenderSample
{
    /** @var array */
    private static $data = [
        'octocat' => [
            'userId'            => 1,
            'login'             => 'octocat',
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
    ];

    public static function serialized(string $item): array
    {
        return self::$data[$item];
    }

    public static function octocat(): Sender
    {
        return Sender::deserialize(self::$data['octocat']);
    }
}
