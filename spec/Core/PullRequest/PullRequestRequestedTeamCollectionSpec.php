<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeam;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeamCollection;
use PhpSpec\ObjectBehavior;

class PullRequestRequestedTeamCollectionSpec extends ObjectBehavior
{
    public function let(PullRequestRequestedTeam $pullRequestRequestedTeam)
    {
        $this->beConstructedWith($elements = [$pullRequestRequestedTeam]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PullRequestRequestedTeamCollection::class);
    }

    public function it_exposes_elements(PullRequestRequestedTeam $pullRequestRequestedTeam)
    {
        $this->toArray()->shouldReturn([$pullRequestRequestedTeam]);
    }

    public function it_exposes_number_of_elements_in_collection()
    {
        $this->count()->shouldReturn(1);
    }

    public function it_supports_add_new_element(PullRequestRequestedTeam $anotherPullRequestRequestedTeam)
    {
        $this->add($anotherPullRequestRequestedTeam);
        $this->count()->shouldReturn(2);
    }

    public function it_knows_if_element_is_in_collection(PullRequestRequestedTeam $pullRequestRequestedTeam)
    {
        $pullRequestRequestedTeam->getTodo()->shouldBeCalled()->willReturn('element');
        $this->has('element')->shouldReturn(true);
    }

    public function it_can_return_element_from_collection_by_given_id(
        PullRequestRequestedTeam $pullRequestRequestedTeam
    ) {
        $pullRequestRequestedTeam->getTodo()->shouldBeCalled()->willReturn('element');
        $this->get('element')->shouldReturn($pullRequestRequestedTeam);
    }
}
