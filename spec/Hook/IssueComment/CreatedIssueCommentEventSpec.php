<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Hook\IssueComment;

use Data\DevboardLib\GitHubWebhook\Core\Issue\IssueAssigneeSample;
use Data\DevboardLib\GitHubWebhook\Core\Issue\IssueAuthorSample;
use Data\DevboardLib\GitHubWebhook\Core\IssueComment\IssueCommentAuthorSample;
use Data\DevboardLib\GitHubWebhook\Core\Label\LabelSample;
use Data\DevboardLib\GitHubWebhook\Core\MilestoneSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\GitHubIssue;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueCommentDetails;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\GitHubHookEvent;
use DevboardLib\GitHubWebhook\Hook\IssueComment\CreatedIssueCommentEvent;
use DevboardLib\GitHubWebhook\Hook\IssueComment\IssueCommentEvent;
use DevboardLib\GitHubWebhook\Hook\RepositoryRelatedEvent;
use PhpSpec\ObjectBehavior;

class CreatedIssueCommentEventSpec extends ObjectBehavior
{
    public function let(
        IssueCommentDetails $comment,
        GitHubIssue $issue,
        Repo $repo,
        InstallationId $installationId,
        Sender $sender
    ) {
        $this->beConstructedWith($comment, $issue, $repo, $installationId, $sender);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CreatedIssueCommentEvent::class);
        $this->shouldImplement(IssueCommentEvent::class);
        $this->shouldImplement(GitHubHookEvent::class);
        $this->shouldImplement(RepositoryRelatedEvent::class);
    }

    public function it_exposes_comment(IssueCommentDetails $comment)
    {
        $this->getComment()->shouldReturn($comment);
    }

    public function it_exposes_issue(GitHubIssue $issue)
    {
        $this->getIssue()->shouldReturn($issue);
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
        IssueCommentDetails $comment,
        GitHubIssue $issue,
        Repo $repo,
        InstallationId $installationId,
        Sender $sender
    ) {
        $comment->serialize()->shouldBeCalled()->willReturn(
            [
                'id'          => 1,
                'issueId'     => 1,
                'body'        => 'value',
                'author'      => IssueCommentAuthorSample::serialized('octocat'),
                'htmlUrl'     => 'htmlUrl',
                'apiUrl'      => 'apiUrl',
                'issueApiUrl' => 'apiUrl',
                'createdAt'   => '2018-01-01T00:01:00+00:00',
                'updatedAt'   => '2018-01-01T00:01:00+00:00',
            ]
        );
        $issue->serialize()->shouldBeCalled()->willReturn(
            [
                'id'        => 1,
                'number'    => 1,
                'title'     => 'value',
                'body'      => 'value',
                'state'     => 'open',
                'author'    => IssueAuthorSample::serialized('octocat'),
                'apiUrl'    => 'apiUrl',
                'htmlUrl'   => 'htmlUrl',
                'assignee'  => IssueAssigneeSample::serialized('octocat'),
                'assignees' => [IssueAssigneeSample::serialized('octocat')],
                'labels'    => [LabelSample::serialized('red')],
                'milestone' => MilestoneSample::serialized('sprint1'),
                'closedAt'  => '2018-01-01T00:01:00+00:00',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ]
        );
        $repo->serialize()->shouldBeCalled()->willReturn(RepoSample::serialized('octocatLinguist'));
        $installationId->serialize()->shouldBeCalled()->willReturn(1);
        $sender->serialize()->shouldBeCalled()->willReturn(SenderSample::serialized('octocat'));
        $this->serialize()->shouldReturn(
            [
                'comment' => [
                    'id'          => 1,
                    'issueId'     => 1,
                    'body'        => 'value',
                    'author'      => IssueCommentAuthorSample::serialized('octocat'),
                    'htmlUrl'     => 'htmlUrl',
                    'apiUrl'      => 'apiUrl',
                    'issueApiUrl' => 'apiUrl',
                    'createdAt'   => '2018-01-01T00:01:00+00:00',
                    'updatedAt'   => '2018-01-01T00:01:00+00:00',
                ],
                'issue' => [
                    'id'        => 1,
                    'number'    => 1,
                    'title'     => 'value',
                    'body'      => 'value',
                    'state'     => 'open',
                    'author'    => IssueAuthorSample::serialized('octocat'),
                    'apiUrl'    => 'apiUrl',
                    'htmlUrl'   => 'htmlUrl',
                    'assignee'  => IssueAssigneeSample::serialized('octocat'),
                    'assignees' => [IssueAssigneeSample::serialized('octocat')],
                    'labels'    => [LabelSample::serialized('red')],
                    'milestone' => MilestoneSample::serialized('sprint1'),
                    'closedAt'  => '2018-01-01T00:01:00+00:00',
                    'createdAt' => '2018-01-01T00:01:00+00:00',
                    'updatedAt' => '2018-01-01T00:01:00+00:00',
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
            'comment' => [
                'id'          => 1,
                'issueId'     => 1,
                'body'        => 'value',
                'author'      => IssueCommentAuthorSample::serialized('octocat'),
                'htmlUrl'     => 'htmlUrl',
                'apiUrl'      => 'apiUrl',
                'issueApiUrl' => 'apiUrl',
                'createdAt'   => '2018-01-01T00:01:00+00:00',
                'updatedAt'   => '2018-01-01T00:01:00+00:00',
            ],
            'issue' => [
                'id'        => 1,
                'number'    => 1,
                'title'     => 'value',
                'body'      => 'value',
                'state'     => 'open',
                'author'    => IssueAuthorSample::serialized('octocat'),
                'apiUrl'    => 'apiUrl',
                'htmlUrl'   => 'htmlUrl',
                'assignee'  => IssueAssigneeSample::serialized('octocat'),
                'assignees' => [IssueAssigneeSample::serialized('octocat')],
                'labels'    => [LabelSample::serialized('red')],
                'milestone' => MilestoneSample::serialized('sprint1'),
                'closedAt'  => '2018-01-01T00:01:00+00:00',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ],
            'repo'           => RepoSample::serialized('octocatLinguist'),
            'installationId' => 1,
            'sender'         => SenderSample::serialized('octocat'),
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(CreatedIssueCommentEvent::class);
    }
}
