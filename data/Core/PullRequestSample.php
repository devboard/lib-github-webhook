<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core;

use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAssigneeSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAuthorSample;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;

class PullRequestSample
{
    public static function serialized(string $item): array
    {
        $data = [
            'pr1' => [
                'id'                  => 1,
                'number'              => 1,
                'base'                => PullRequestBaseSample::serialized('base1'),
                'head'                => PullRequestHeadSample::serialized('head1'),
                'title'               => 'value',
                'body'                => 'value',
                'state'               => 'open',
                'author'              => PullRequestAuthorSample::serialized('octocat'),
                'assignees'           => [PullRequestAssigneeSample::serialized('octocat')],
                'requestedReviewers'  => [PullRequestRequestedReviewerSample::serialized('octocat')],
                'requestedTeams'      => ['todo'],
                'locked'              => true,
                'rebaseable'          => true,
                'maintainerCanModify' => true,
                'mergeCommitSha'      => 'sha',
                'mergeable'           => true,
                'mergeableState'      => 'mergeableState',
                'merged'              => true,
                'mergedAt'            => '2018-01-01T00:01:00+00:00',
                'mergedBy'            => PullRequestMergedBySample::serialized('octocat'),
                'milestone'           => MilestoneSample::serialized('sprint1'),
                'closedAt'            => '2018-01-01T00:01:00+00:00',
                'stats'               => ['additions' => 1, 'changedFiles' => 1, 'comments' => 1, 'commits' => 1, 'deletions' => 1],
                'urls'                => PullRequestUrlsSample::serialized('urls1'),
                'createdAt'           => '2018-01-01T00:01:00+00:00',
                'updatedAt'           => '2018-01-01T00:01:00+00:00',
            ],
        ];

        return $data[$item];
    }

    public static function pr1(): PullRequest
    {
        return PullRequest::deserialize(self::serialized('pr1'));
    }
}
