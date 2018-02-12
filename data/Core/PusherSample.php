<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\Pusher;

class PusherSample
{
    private static $data = ['octocat' => ['name' => 'octocat', 'email' => 'octocat@example.com']];

    public static function serialized(string $item): array
    {
        return self::$data[$item];
    }

    public static function octocat(): Pusher
    {
        return Pusher::deserialize(self::$data['octocat']);
    }
}
