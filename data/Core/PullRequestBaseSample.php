<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestBase;

class PullRequestBaseSample
{
    public static function serialized(string $item): array
    {
        $data = [
            'base1' => [
                'targetBranchName' => 'name',
                'repo'             => RepoSample::serialized('octocatLinguist'),
                'sha'              => 'sha',
            ],
        ];

        return $data[$item];
    }

    public static function base1(): PullRequestBase
    {
        return PullRequestBase::deserialize(self::serialized('base1'));
    }
}
