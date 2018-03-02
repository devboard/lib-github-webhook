<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestUrls;

class PullRequestUrlsSample
{
    public static function serialized(string $item): array
    {
        $data = [
            'urls1' => [
                'apiUrl'            => 'apiUrl',
                'htmlUrl'           => 'htmlUrl',
                'commentsUrl'       => 'commentsUrl',
                'commitsUrl'        => 'commitsUrl',
                'diffUrl'           => 'diffUrl',
                'issueUrl'          => 'issueUrl',
                'patchUrl'          => 'patchUrl',
                'reviewCommentUrl'  => 'reviewCommentUrl',
                'reviewComments'    => 1,
                'reviewCommentsUrl' => 'reviewCommentsUrl',
                'statusesUrl'       => 'statusesUrl',
            ],
        ];

        return $data[$item];
    }

    public static function urls1(): PullRequestUrls
    {
        return PullRequestUrls::deserialize(self::serialized('urls1'));
    }
}
