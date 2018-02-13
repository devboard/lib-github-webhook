<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core\Status;

use DevboardLib\GitHubWebhook\Core\Status\Commit;

class CommitSample
{
    private static $data = [
        'abc234' => [
            'sha'        => 'sha',
            'message'    => 'message',
            'commitDate' => '2018-01-01T00:01:00+00:00',
            'author'     => [
                'name'      => 'name',
                'email'     => 'octocat@example.com',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'details'   => [
                    'userId'            => 1,
                    'login'             => 'value',
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
            ],
            'committer' => [
                'name'        => 'name',
                'email'       => 'octocat@example.com',
                'committedAt' => '2018-01-01T00:01:00+00:00',
                'details'     => [
                    'userId'            => 1,
                    'login'             => 'value',
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
            ],
            'tree'         => ['sha' => 'sha', 'apiUrl' => 'url'],
            'parents'      => [['sha' => 'sha', 'apiUrl' => 'apiUrl', 'htmlUrl' => 'htmlUrl']],
            'verification' => [
                'verified'  => true,
                'reason'    => 'reason',
                'signature' => 'signature',
                'payload'   => 'payload',
            ],
            'apiUrl'      => 'apiUrl',
            'htmlUrl'     => 'htmlUrl',
            'commentsUrl' => 'commentsUrl',
        ],
    ];

    public static function serialized(string $item): array
    {
        return self::$data[$item];
    }

    public static function abc234(): Commit
    {
        return Commit::deserialize(self::$data['abc234']);
    }
}
