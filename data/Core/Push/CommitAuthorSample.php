<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\GitHubWebhook\Core\Push\CommitAuthor;

class CommitAuthorSample
{
    private static $data = [
        'octocat' => ['name' => 'Octo Cat', 'email' => 'octocat@example.com', 'username' => 'octocat'],
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
