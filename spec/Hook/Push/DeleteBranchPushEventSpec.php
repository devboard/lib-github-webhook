<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Hook\Push;

use Data\DevboardLib\GitHubWebhook\Core\Push\PusherSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHubWebhook\Core\Push\Pusher;
use DevboardLib\GitHubWebhook\Core\Push\Ref;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\GitHubHookEvent;
use DevboardLib\GitHubWebhook\Hook\Push\DeleteBranchPushEvent;
use DevboardLib\GitHubWebhook\Hook\PushEvent;
use PhpSpec\ObjectBehavior;

class DeleteBranchPushEventSpec extends ObjectBehavior
{
    public function let(Ref $ref, CommitSha $before, Repo $repo, Pusher $pusher, Sender $sender)
    {
        $this->beConstructedWith($ref, $before, $repo, $forced = false, $pusher, $sender);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DeleteBranchPushEvent::class);
        $this->shouldImplement(PushEvent::class);
        $this->shouldImplement(GitHubHookEvent::class);
    }

    public function it_exposes_ref(Ref $ref)
    {
        $this->getRef()->shouldReturn($ref);
    }

    public function it_exposes_before(CommitSha $before)
    {
        $this->getBefore()->shouldReturn($before);
    }

    public function it_exposes_repo(Repo $repo)
    {
        $this->getRepo()->shouldReturn($repo);
    }

    public function it_exposes_pusher(Pusher $pusher)
    {
        $this->getPusher()->shouldReturn($pusher);
    }

    public function it_exposes_sender(Sender $sender)
    {
        $this->getSender()->shouldReturn($sender);
    }

    public function it_can_be_serialized(Ref $ref, CommitSha $before, Repo $repo, Pusher $pusher, Sender $sender)
    {
        $ref->serialize()->shouldBeCalled()->willReturn('refs/heads/new-feature-branch');
        $before->serialize()->shouldBeCalled()->willReturn('sha');
        $repo->serialize()->shouldBeCalled()->willReturn(RepoSample::serialized('octocatLinguist'));
        $pusher->serialize()->shouldBeCalled()->willReturn(PusherSample::serialized('octocat'));
        $sender->serialize()->shouldBeCalled()->willReturn(SenderSample::serialized('octocat'));
        $this->serialize()->shouldReturn(
            [
                'ref'    => 'refs/heads/new-feature-branch',
                'before' => 'sha',
                'repo'   => RepoSample::serialized('octocatLinguist'),
                'forced' => false,
                'pusher' => PusherSample::serialized('octocat'),
                'sender' => SenderSample::serialized('octocat'),
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'ref'    => 'refs/heads/new-feature-branch',
            'before' => 'sha',
            'repo'   => RepoSample::serialized('octocatLinguist'),
            'forced' => false,
            'pusher' => PusherSample::serialized('octocat'),
            'sender' => SenderSample::serialized('octocat'),
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(DeleteBranchPushEvent::class);
    }
}
