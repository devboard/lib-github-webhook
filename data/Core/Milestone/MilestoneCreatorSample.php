<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core\Milestone;

use DevboardLib\GitHub\Milestone\MilestoneCreator;

class MilestoneCreatorSample
{
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

    public static function octocat(): MilestoneCreator
    {
        return MilestoneCreator::deserialize(self::$data['octocat']);
    }
}
