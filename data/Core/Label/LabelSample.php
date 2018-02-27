<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core\Label;

use DevboardLib\GitHub\GitHubLabel;

class LabelSample
{
    private static $data = [
        'red' => ['id' => 1, 'name' => 'value', 'color' => 'color', 'default' => true, 'apiUrl' => 'apiUrl'],
    ];

    public static function serialized(string $item): array
    {
        return self::$data[$item];
    }

    public static function red(): GitHubLabel
    {
        return GitHubLabel::deserialize(self::$data['red']);
    }
}
