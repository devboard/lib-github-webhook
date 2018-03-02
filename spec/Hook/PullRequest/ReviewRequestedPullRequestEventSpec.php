<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Hook\PullRequest;

use Data\DevboardLib\GitHubWebhook\Core\PullRequestSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHub\PullRequest\PullRequestReviewer;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\PullRequest\PullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\ReviewRequestedPullRequestEvent;
use PhpSpec\ObjectBehavior;

class ReviewRequestedPullRequestEventSpec extends ObjectBehavior
{
    public function let(
        PullRequest $pullRequest,
        PullRequestReviewer $reviewer,
        Repo $repo,
        InstallationId $installationId,
        Sender $sender
    ) {
        $this->beConstructedWith($pullRequest, $reviewer, $repo, $installationId, $sender);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(ReviewRequestedPullRequestEvent::class);
        $this->shouldImplement(PullRequestEvent::class);
    }

    public function it_exposes_pull_request(PullRequest $pullRequest)
    {
        $this->getPullRequest()->shouldReturn($pullRequest);
    }

    public function it_exposes_reviewer(PullRequestReviewer $reviewer)
    {
        $this->getReviewer()->shouldReturn($reviewer);
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
        PullRequest $pullRequest,
        PullRequestReviewer $reviewer,
        Repo $repo,
        InstallationId $installationId,
        Sender $sender
    ) {
        $pullRequest->serialize()->shouldBeCalled()->willReturn(PullRequestSample::serialized('pr1'));
        $reviewer->serialize()->shouldBeCalled()->willReturn(
            [
                'userId'      => 1,
                'login'       => 'value',
                'accountType' => 'User',
                'avatarUrl'   => 'avatarUrl',
                'gravatarId'  => 'id',
                'htmlUrl'     => 'htmlUrl',
                'apiUrl'      => 'apiUrl',
                'siteAdmin'   => true,
            ]
        );
        $repo->serialize()->shouldBeCalled()->willReturn(RepoSample::serialized('octocatLinguist'));
        $installationId->serialize()->shouldBeCalled()->willReturn(1);
        $sender->serialize()->shouldBeCalled()->willReturn(SenderSample::serialized('octocat'));
        $this->serialize()->shouldReturn(
            [
                'pullRequest' => PullRequestSample::serialized('pr1'),
                'reviewer'    => [
                    'userId'      => 1,
                    'login'       => 'value',
                    'accountType' => 'User',
                    'avatarUrl'   => 'avatarUrl',
                    'gravatarId'  => 'id',
                    'htmlUrl'     => 'htmlUrl',
                    'apiUrl'      => 'apiUrl',
                    'siteAdmin'   => true,
                ],
                'repo'           => RepoSample::serialized('octocatLinguist'),
                'installationId' => 1,
                'sender'         => SenderSample::serialized('octocat'),
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'pullRequest' => PullRequestSample::serialized('pr1'),
            'reviewer'    => [
                'userId'      => 1,
                'login'       => 'value',
                'accountType' => 'User',
                'avatarUrl'   => 'avatarUrl',
                'gravatarId'  => 'id',
                'htmlUrl'     => 'htmlUrl',
                'apiUrl'      => 'apiUrl',
                'siteAdmin'   => true,
            ],
            'repo'           => RepoSample::serialized('octocatLinguist'),
            'installationId' => 1,
            'sender'         => SenderSample::serialized('octocat'),
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(ReviewRequestedPullRequestEvent::class);
    }
}
