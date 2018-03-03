<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Hook\PullRequest;

use Data\DevboardLib\GitHubWebhook\Core\PullRequestSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\GitHubHookEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\EditedPullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\PullRequestEvent;
use PhpSpec\ObjectBehavior;

class EditedPullRequestEventSpec extends ObjectBehavior
{
    public function let(PullRequest $pullRequest, Repo $repo, InstallationId $installationId, Sender $sender)
    {
        $this->beConstructedWith($pullRequest, $repo, $installationId, $sender);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(EditedPullRequestEvent::class);
        $this->shouldImplement(PullRequestEvent::class);
        $this->shouldImplement(GitHubHookEvent::class);
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
        PullRequest $pullRequest, Repo $repo, InstallationId $installationId, Sender $sender
    ) {
        $pullRequest->serialize()->shouldBeCalled()->willReturn(PullRequestSample::serialized('pr1'));
        $repo->serialize()->shouldBeCalled()->willReturn(RepoSample::serialized('octocatLinguist'));
        $installationId->serialize()->shouldBeCalled()->willReturn(1);
        $sender->serialize()->shouldBeCalled()->willReturn(SenderSample::serialized('octocat'));
        $this->serialize()->shouldReturn(
            [
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
            'pullRequest'    => PullRequestSample::serialized('pr1'),
            'repo'           => RepoSample::serialized('octocatLinguist'),
            'installationId' => 1,
            'sender'         => SenderSample::serialized('octocat'),
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(EditedPullRequestEvent::class);
    }
}
