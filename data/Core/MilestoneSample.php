<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHub\GitHubMilestone;

class MilestoneSample
{
    /** @var array */
    private static $data = [
        'sprint1' => [
            'id'          => 1,
            'title'       => 'value',
            'description' => 'value',
            'dueOn'       => '2018-01-01T00:01:00+00:00',
            'state'       => 'open',
            'number'      => 1,
            'creator'     => [
                'userId'    => 1,
                'login'     => 'octocat',
                'type'      => 'User',
                'avatarUrl' => 'avatarUrl',
                'siteAdmin' => true,
            ],
            'closedAt'  => '2018-01-01T00:01:00+00:00',
            'createdAt' => '2018-01-01T00:01:00+00:00',
            'updatedAt' => '2018-01-01T00:01:00+00:00',
        ],
    ];

    public static function serialized(string $item): array
    {
        return self::$data[$item];
    }

    public static function sprint1(): GitHubMilestone
    {
        return GitHubMilestone::deserialize(self::$data['sprint1']);
    }
}
