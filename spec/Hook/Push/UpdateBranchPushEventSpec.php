<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Hook\Push;

use Data\DevboardLib\GitHubWebhook\Core\Push\CommitSample;
use Data\DevboardLib\GitHubWebhook\Core\Push\PusherSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHubWebhook\Core\Push\Commit;
use DevboardLib\GitHubWebhook\Core\Push\CommitCollection;
use DevboardLib\GitHubWebhook\Core\Push\CompareChangesUrl;
use DevboardLib\GitHubWebhook\Core\Push\Pusher;
use DevboardLib\GitHubWebhook\Core\Push\Ref;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\Push\UpdateBranchPushEvent;
use DevboardLib\GitHubWebhook\Hook\PushEvent;
use PhpSpec\ObjectBehavior;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 */
class UpdateBranchPushEventSpec extends ObjectBehavior
{
    public function let(
        Ref $ref,
        CommitSha $before,
        CommitSha $after,
        Ref $baseRef,
        CompareChangesUrl $changesUrl,
        CommitCollection $commits,
        Commit $headCommit,
        Repo $repo,
        Pusher $pusher,
        Sender $sender
    ) {
        $this->beConstructedWith(
            $ref,
            $before,
            $after,
            $baseRef,
            $changesUrl,
            $commits,
            $headCommit,
            $repo,
            $forced = false,
            $pusher,
            $sender
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(UpdateBranchPushEvent::class);
        $this->shouldImplement(PushEvent::class);
    }

    public function it_exposes_ref(Ref $ref)
    {
        $this->getRef()->shouldReturn($ref);
    }

    public function it_exposes_before(CommitSha $before)
    {
        $this->getBefore()->shouldReturn($before);
    }

    public function it_exposes_after(CommitSha $after)
    {
        $this->getAfter()->shouldReturn($after);
    }

    public function it_exposes_base_ref(Ref $baseRef)
    {
        $this->getBaseRef()->shouldReturn($baseRef);
    }

    public function it_exposes_changes_url(CompareChangesUrl $changesUrl)
    {
        $this->getChangesUrl()->shouldReturn($changesUrl);
    }

    public function it_exposes_commits(CommitCollection $commits)
    {
        $this->getCommits()->shouldReturn($commits);
    }

    public function it_exposes_head_commit(Commit $headCommit)
    {
        $this->getHeadCommit()->shouldReturn($headCommit);
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

    public function it_has_base_ref()
    {
        $this->hasBaseRef()->shouldReturn(true);
    }

    public function it_can_be_serialized(
        Ref $ref,
        CommitSha $before,
        CommitSha $after,
        Ref $baseRef,
        CompareChangesUrl $changesUrl,
        CommitCollection $commits,
        Commit $headCommit,
        Repo $repo,
        Pusher $pusher,
        Sender $sender
    ) {
        $ref->serialize()->shouldBeCalled()->willReturn('refs/heads/new-feature-branch');
        $before->serialize()->shouldBeCalled()->willReturn('sha');
        $after->serialize()->shouldBeCalled()->willReturn('sha');
        $baseRef->serialize()->shouldBeCalled()->willReturn('refs/heads/master');
        $changesUrl->serialize()->shouldBeCalled()->willReturn('url');
        $commits->serialize()->shouldBeCalled()->willReturn([CommitSample::serialized('abc123')]);
        $headCommit->serialize()->shouldBeCalled()->willReturn(CommitSample::serialized('abc123'));
        $repo->serialize()->shouldBeCalled()->willReturn(RepoSample::serialized('octocatLinguist'));
        $pusher->serialize()->shouldBeCalled()->willReturn(PusherSample::serialized('octocat'));
        $sender->serialize()->shouldBeCalled()->willReturn(SenderSample::serialized('octocat'));
        $this->serialize()->shouldReturn(
            [
                'ref'        => 'refs/heads/new-feature-branch',
                'before'     => 'sha',
                'after'      => 'sha',
                'baseRef'    => 'refs/heads/master',
                'changesUrl' => 'url',
                'commits'    => [CommitSample::serialized('abc123')],
                'headCommit' => CommitSample::serialized('abc123'),
                'repo'       => RepoSample::serialized('octocatLinguist'),
                'forced'     => false,
                'pusher'     => PusherSample::serialized('octocat'),
                'sender'     => SenderSample::serialized('octocat'),
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'ref'        => 'refs/heads/new-feature-branch',
            'before'     => 'sha',
            'after'      => 'sha',
            'baseRef'    => 'refs/heads/master',
            'changesUrl' => 'url',
            'commits'    => [CommitSample::serialized('abc123')],
            'headCommit' => CommitSample::serialized('abc123'),
            'repo'       => RepoSample::serialized('octocatLinguist'),
            'forced'     => false,
            'pusher'     => PusherSample::serialized('octocat'),
            'sender'     => SenderSample::serialized('octocat'),
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(UpdateBranchPushEvent::class);
    }
}
