<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\GitHubWebhook\Core\Push\CommitCommitter;

class CommitCommitterSample
{
    /** @var array */
    private static $data = [
        'octocat' => ['name' => 'Octo Cat', 'email' => 'octocat@example.com', 'username' => 'octocat'],
    ];

    public static function serialized(string $item): array
    {
        return self::$data[$item];
    }

    public static function octocat(): CommitCommitter
    {
        return CommitCommitter::deserialize(self::$data['octocat']);
    }
}
