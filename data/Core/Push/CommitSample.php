<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\GitHubWebhook\Core\Push\Commit;

class CommitSample
{
    /** @var array */
    private static $data = [
        'abc123' => [
            'sha'           => 'abc123',
            'message'       => 'Commit message',
            'commitDate'    => '2018-01-01T00:01:00+00:00',
            'author'        => ['name' => 'Octo Cat', 'email' => 'octocat@example.com', 'username' => 'octocat','details'=> null],
            'committer'     => ['name' => 'Octo Cat', 'email' => 'octocat@example.com', 'username' => 'octocat','details'=> null],
            'tree'          => 'sha',
            'distinct'      => true,
            'addedFiles'    => ['data'],
            'modifiedFiles' => ['data'],
            'removedFiles'  => ['data'],
        ],
    ];

    public static function serialized(string $item): array
    {
        return self::$data[$item];
    }

    public static function abc123(): Commit
    {
        return Commit::deserialize(self::$data['abc123']);
    }
}
