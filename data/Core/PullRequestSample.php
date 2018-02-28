<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core;

use Data\DevboardLib\GitHubWebhook\Core\Label\LabelSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAssigneeSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAuthorSample;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;

class PullRequestSample
{
    public static function serialized(string $item): array
    {
        $data = [
            'pr1' => [
                'id'        => 1,
                'number'    => 1,
                'title'     => 'value',
                'body'      => 'value',
                'state'     => 'open',
                'author'    => PullRequestAuthorSample::serialized('octocat'),
                'apiUrl'    => 'apiUrl',
                'htmlUrl'   => 'htmlUrl',
                'assignee'  => PullRequestAssigneeSample::serialized('octocat'),
                'assignees' => [PullRequestAssigneeSample::serialized('octocat')],
                'labels'    => [LabelSample::serialized('red')],
                'milestone' => MilestoneSample::serialized('sprint1'),
                'closedAt'  => '2018-01-01T00:01:00+00:00',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ],
        ];

        return $data[$item];
    }

    public static function pr1(): PullRequest
    {
        return PullRequest::deserialize(self::serialized('pr1'));
    }
}
