<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\GitHubWebhook\Core\Push\Pusher;

class PusherSample
{
    /** @var array */
    private static $data = ['octocat' => ['login' => 'octocat', 'emailAddress' => 'octocat@example.com']];

    public static function serialized(string $item): array
    {
        return self::$data[$item];
    }

    public static function octocat(): Pusher
    {
        return Pusher::deserialize(self::$data['octocat']);
    }
}
