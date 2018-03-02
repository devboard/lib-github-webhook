<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHub\User\UserId;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedReviewer;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedReviewerCollection;
use PhpSpec\ObjectBehavior;

class PullRequestRequestedReviewerCollectionSpec extends ObjectBehavior
{
    public function let(PullRequestRequestedReviewer $pullRequestRequestedReviewer)
    {
        $this->beConstructedWith($elements = [$pullRequestRequestedReviewer]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PullRequestRequestedReviewerCollection::class);
    }

    public function it_exposes_elements(PullRequestRequestedReviewer $pullRequestRequestedReviewer)
    {
        $this->toArray()->shouldReturn([$pullRequestRequestedReviewer]);
    }

    public function it_exposes_number_of_elements_in_collection()
    {
        $this->count()->shouldReturn(1);
    }

    public function it_supports_add_new_element(PullRequestRequestedReviewer $anotherPullRequestRequestedReviewer)
    {
        $this->add($anotherPullRequestRequestedReviewer);
        $this->count()->shouldReturn(2);
    }

    public function it_knows_if_element_is_in_collection(
        PullRequestRequestedReviewer $pullRequestRequestedReviewer, UserId $userId
    ) {
        $pullRequestRequestedReviewer->getUserId()->shouldBeCalled()->willReturn($userId);
        $this->has($userId)->shouldReturn(true);
    }

    public function it_can_return_element_from_collection_by_given_id(
        PullRequestRequestedReviewer $pullRequestRequestedReviewer, UserId $userId
    ) {
        $pullRequestRequestedReviewer->getUserId()->shouldBeCalled()->willReturn($userId);
        $this->get($userId)->shouldReturn($pullRequestRequestedReviewer);
    }
}
