<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeam;
use PhpSpec\ObjectBehavior;

class PullRequestRequestedTeamSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith($todo = 'todo');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PullRequestRequestedTeam::class);
    }

    public function it_exposes_todo()
    {
        $this->getTodo()->shouldReturn('todo');
    }

    public function it_can_be_serialized()
    {
        $this->serialize()->shouldReturn('todo');
    }

    public function it_can_be_deserialized()
    {
        $input = 'todo';

        $this->deserialize($input)->shouldReturnAnInstanceOf(PullRequestRequestedTeam::class);
    }
}
