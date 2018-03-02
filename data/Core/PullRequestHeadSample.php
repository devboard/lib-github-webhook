<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestHead;

class PullRequestHeadSample
{
    public static function serialized(string $item): array
    {
        $data = [
            'head1' => [
                'sourceBranchName' => 'name',
                'repo'             => RepoSample::serialized('octocatLinguist'),
                'sha'              => 'sha',
            ],
        ];

        return $data[$item];
    }

    public static function head1(): PullRequestHead
    {
        return PullRequestHead::deserialize(self::serialized('head1'));
    }
}
