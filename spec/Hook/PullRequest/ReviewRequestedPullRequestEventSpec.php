<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Hook\PullRequest;

use Data\DevboardLib\GitHubWebhook\Core\Label\LabelSample;
use Data\DevboardLib\GitHubWebhook\Core\Milestone\MilestoneCreatorSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAssigneeSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAuthorSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\GitHubPullRequest;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHub\PullRequest\PullRequestReviewer;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\PullRequest\PullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\ReviewRequestedPullRequestEvent;
use PhpSpec\ObjectBehavior;

class ReviewRequestedPullRequestEventSpec extends ObjectBehavior
{
    public function let(
        GitHubPullRequest $pullRequest,
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

    public function it_exposes_pull_request(GitHubPullRequest $pullRequest)
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
        GitHubPullRequest $pullRequest,
        PullRequestReviewer $reviewer,
        Repo $repo,
        InstallationId $installationId,
        Sender $sender
    ) {
        $pullRequest->serialize()->shouldBeCalled()->willReturn(
            [
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
                'milestone' => [
                    'id'          => 1,
                    'title'       => 'value',
                    'description' => 'value',
                    'dueOn'       => '2018-01-01T00:01:00+00:00',
                    'state'       => 'open',
                    'number'      => 1,
                    'creator'     => MilestoneCreatorSample::serialized('octocat'),
                    'htmlUrl'     => 'htmlUrl',
                    'apiUrl'      => 'apiUrl',
                    'closedAt'    => '2018-01-01T00:01:00+00:00',
                    'createdAt'   => '2018-01-01T00:01:00+00:00',
                    'updatedAt'   => '2018-01-01T00:01:00+00:00',
                ],
                'closedAt'  => '2018-01-01T00:01:00+00:00',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ]
        );
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
                'pullRequest' => [
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
                    'milestone' => [
                        'id'          => 1,
                        'title'       => 'value',
                        'description' => 'value',
                        'dueOn'       => '2018-01-01T00:01:00+00:00',
                        'state'       => 'open',
                        'number'      => 1,
                        'creator'     => MilestoneCreatorSample::serialized('octocat'),
                        'htmlUrl'     => 'htmlUrl',
                        'apiUrl'      => 'apiUrl',
                        'closedAt'    => '2018-01-01T00:01:00+00:00',
                        'createdAt'   => '2018-01-01T00:01:00+00:00',
                        'updatedAt'   => '2018-01-01T00:01:00+00:00',
                    ],
                    'closedAt'  => '2018-01-01T00:01:00+00:00',
                    'createdAt' => '2018-01-01T00:01:00+00:00',
                    'updatedAt' => '2018-01-01T00:01:00+00:00',
                ],
                'reviewer' => [
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
            'pullRequest' => [
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
                'milestone' => [
                    'id'          => 1,
                    'title'       => 'value',
                    'description' => 'value',
                    'dueOn'       => '2018-01-01T00:01:00+00:00',
                    'state'       => 'open',
                    'number'      => 1,
                    'creator'     => MilestoneCreatorSample::serialized('octocat'),
                    'htmlUrl'     => 'htmlUrl',
                    'apiUrl'      => 'apiUrl',
                    'closedAt'    => '2018-01-01T00:01:00+00:00',
                    'createdAt'   => '2018-01-01T00:01:00+00:00',
                    'updatedAt'   => '2018-01-01T00:01:00+00:00',
                ],
                'closedAt'  => '2018-01-01T00:01:00+00:00',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ],
            'reviewer' => [
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
