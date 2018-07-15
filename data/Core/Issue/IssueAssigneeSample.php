<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core\Issue;

use DevboardLib\GitHub\Issue\IssueAssignee;

class IssueAssigneeSample
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

    public static function octocat(): IssueAssignee
    {
        return IssueAssignee::deserialize(self::$data['octocat']);
    }
}
