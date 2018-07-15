<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core\Label;

use DevboardLib\GitHub\GitHubLabel;

class LabelSample
{
    /** @var array */
    private static $data = ['red' => ['id' => 1, 'name' => 'red', 'color' => '#ff0000', 'default' => true]];

    public static function serialized(string $item): array
    {
        return self::$data[$item];
    }

    public static function red(): GitHubLabel
    {
        return GitHubLabel::deserialize(self::$data['red']);
    }
}
