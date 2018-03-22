<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Hook\PullRequestReview;

use Data\DevboardLib\GitHubWebhook\Core\PullRequestReviewSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequestSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReview;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\PullRequestReview\DismissedPullRequestReview;
use DevboardLib\GitHubWebhook\Hook\PullRequestReview\PullRequestReviewEvent;
use PhpSpec\ObjectBehavior;

class DismissedPullRequestReviewSpec extends ObjectBehavior
{
    public function let(
        PullRequestReview $review,
        PullRequest $pullRequest,
        Repo $repo,
        InstallationId $installationId,
        Sender $sender
    ) {
        $this->beConstructedWith($review, $pullRequest, $repo, $installationId, $sender);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DismissedPullRequestReview::class);
        $this->shouldImplement(PullRequestReviewEvent::class);
    }

    public function it_exposes_review(PullRequestReview $review)
    {
        $this->getReview()->shouldReturn($review);
    }

    public function it_exposes_pull_request(PullRequest $pullRequest)
    {
        $this->getPullRequest()->shouldReturn($pullRequest);
    }

    public function it_exposes_repo(Repo $repo)
    {
        $this->getRepo()->shouldReturn($repo);
    }

    public function it_exposes_installation_id(InstallationId $installationId)
    {
        $this->getInstallationId()->shouldReturn($installationId);
    }

    public function it_exposes_sender(Sender $sender)
    {
        $this->getSender()->shouldReturn($sender);
    }

    public function it_can_be_serialized(
        PullRequestReview $review,
        PullRequest $pullRequest,
        Repo $repo,
        InstallationId $installationId,
        Sender $sender
    ) {
        $review->serialize()->shouldBeCalled()->willReturn(PullRequestReviewSample::serialized('rev1'));
        $pullRequest->serialize()->shouldBeCalled()->willReturn(PullRequestSample::serialized('pr1'));
        $repo->serialize()->shouldBeCalled()->willReturn(RepoSample::serialized('octocatLinguist'));
        $installationId->serialize()->shouldBeCalled()->willReturn(1);
        $sender->serialize()->shouldBeCalled()->willReturn(SenderSample::serialized('octocat'));
        $this->serialize()->shouldReturn(
            [
                'review'         => PullRequestReviewSample::serialized('rev1'),
                'pullRequest'    => PullRequestSample::serialized('pr1'),
                'repo'           => RepoSample::serialized('octocatLinguist'),
                'installationId' => 1,
                'sender'         => SenderSample::serialized('octocat'),
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'review'         => PullRequestReviewSample::serialized('rev1'),
            'pullRequest'    => PullRequestSample::serialized('pr1'),
            'repo'           => RepoSample::serialized('octocatLinguist'),
            'installationId' => 1,
            'sender'         => SenderSample::serialized('octocat'),
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(DismissedPullRequestReview::class);
    }
}
