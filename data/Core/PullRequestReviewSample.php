<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core;

use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAuthorSample;
use DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReview;

class PullRequestReviewSample
{
    public static function serialized(string $item): array
    {
        $data = [
            'rev1' => [
                'id'          => 1,
                'body'        => 'value',
                'author'      => PullRequestAuthorSample::serialized('octocat'),
                'state'       => 'approved',
                'commitSha'   => 'sha',
                'urls'        => ['htmlUrl' => 'htmlUrl', 'pullRequestApiUrl' => 'apiUrl'],
                'submittedAt' => '2018-01-01T00:01:00+00:00',
            ],
        ];

        return $data[$item];
    }

    public static function rev1(): PullRequestReview
    {
        return PullRequestReview::deserialize(self::serialized('rev1'));
    }
}
