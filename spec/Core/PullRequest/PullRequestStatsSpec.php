<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestStats;
use PhpSpec\ObjectBehavior;

class PullRequestStatsSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith($additions = 1, $changedFiles = 1, $comments = 1, $commits = 1, $deletions = 1);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PullRequestStats::class);
    }

    public function it_exposes_additions()
    {
        $this->getAdditions()->shouldReturn(1);
    }

    public function it_exposes_changed_files()
    {
        $this->getChangedFiles()->shouldReturn(1);
    }

    public function it_exposes_comments()
    {
        $this->getComments()->shouldReturn(1);
    }

    public function it_exposes_commits()
    {
        $this->getCommits()->shouldReturn(1);
    }

    public function it_exposes_deletions()
    {
        $this->getDeletions()->shouldReturn(1);
    }

    public function it_can_be_serialized()
    {
        $this->serialize()->shouldReturn(
            ['additions' => 1, 'changedFiles' => 1, 'comments' => 1, 'commits' => 1, 'deletions' => 1]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = ['additions' => 1, 'changedFiles' => 1, 'comments' => 1, 'commits' => 1, 'deletions' => 1];

        $this->deserialize($input)->shouldReturnAnInstanceOf(PullRequestStats::class);
    }
}
