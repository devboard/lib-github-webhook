<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Hook\IssueComment;

use Data\DevboardLib\GitHubWebhook\Core\Issue\IssueAssigneeSample;
use Data\DevboardLib\GitHubWebhook\Core\Issue\IssueAuthorSample;
use Data\DevboardLib\GitHubWebhook\Core\IssueComment\IssueCommentAuthorSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\GitHubIssue;
use DevboardLib\GitHub\GitHubIssueComment;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\IssueComment\EditedIssueCommentEvent;
use DevboardLib\GitHubWebhook\Hook\IssueComment\IssueCommentEvent;
use PhpSpec\ObjectBehavior;

class EditedIssueCommentEventSpec extends ObjectBehavior
{
    public function let(
        GitHubIssueComment $comment, GitHubIssue $issue, Repo $repo, InstallationId $installationId, Sender $sender
    ) {
        $this->beConstructedWith($comment, $issue, $repo, $installationId, $sender);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(EditedIssueCommentEvent::class);
        $this->shouldImplement(IssueCommentEvent::class);
    }

    public function it_exposes_comment(GitHubIssueComment $comment)
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
        GitHubIssueComment $comment, GitHubIssue $issue, Repo $repo, InstallationId $installationId, Sender $sender
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
                'labels'    => [
                    ['id' => 1, 'name' => 'value', 'color' => 'color', 'default' => true, 'apiUrl' => 'apiUrl'],
                ],
                'milestone' => [
                    'id'          => 1,
                    'title'       => 'value',
                    'description' => 'value',
                    'dueOn'       => '2018-01-01T00:01:00+00:00',
                    'state'       => 'open',
                    'number'      => 1,
                    'creator'     => [
                        'userId'     => 1,
                        'login'      => 'value',
                        'type'       => 'User',
                        'avatarUrl'  => 'avatarUrl',
                        'gravatarId' => 'id',
                        'htmlUrl'    => 'htmlUrl',
                        'apiUrl'     => 'apiUrl',
                        'siteAdmin'  => true,
                    ],
                    'htmlUrl'   => 'htmlUrl',
                    'apiUrl'    => 'apiUrl',
                    'closedAt'  => '2018-01-01T00:01:00+00:00',
                    'createdAt' => '2018-01-01T00:01:00+00:00',
                    'updatedAt' => '2018-01-01T00:01:00+00:00',
                ],
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
                    'labels'    => [
                        ['id' => 1, 'name' => 'value', 'color' => 'color', 'default' => true, 'apiUrl' => 'apiUrl'],
                    ],
                    'milestone' => [
                        'id'          => 1,
                        'title'       => 'value',
                        'description' => 'value',
                        'dueOn'       => '2018-01-01T00:01:00+00:00',
                        'state'       => 'open',
                        'number'      => 1,
                        'creator'     => [
                            'userId'     => 1,
                            'login'      => 'value',
                            'type'       => 'User',
                            'avatarUrl'  => 'avatarUrl',
                            'gravatarId' => 'id',
                            'htmlUrl'    => 'htmlUrl',
                            'apiUrl'     => 'apiUrl',
                            'siteAdmin'  => true,
                        ],
                        'htmlUrl'   => 'htmlUrl',
                        'apiUrl'    => 'apiUrl',
                        'closedAt'  => '2018-01-01T00:01:00+00:00',
                        'createdAt' => '2018-01-01T00:01:00+00:00',
                        'updatedAt' => '2018-01-01T00:01:00+00:00',
                    ],
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
                'labels'    => [
                    ['id' => 1, 'name' => 'value', 'color' => 'color', 'default' => true, 'apiUrl' => 'apiUrl'],
                ],
                'milestone' => [
                    'id'          => 1,
                    'title'       => 'value',
                    'description' => 'value',
                    'dueOn'       => '2018-01-01T00:01:00+00:00',
                    'state'       => 'open',
                    'number'      => 1,
                    'creator'     => [
                        'userId'     => 1,
                        'login'      => 'value',
                        'type'       => 'User',
                        'avatarUrl'  => 'avatarUrl',
                        'gravatarId' => 'id',
                        'htmlUrl'    => 'htmlUrl',
                        'apiUrl'     => 'apiUrl',
                        'siteAdmin'  => true,
                    ],
                    'htmlUrl'   => 'htmlUrl',
                    'apiUrl'    => 'apiUrl',
                    'closedAt'  => '2018-01-01T00:01:00+00:00',
                    'createdAt' => '2018-01-01T00:01:00+00:00',
                    'updatedAt' => '2018-01-01T00:01:00+00:00',
                ],
                'closedAt'  => '2018-01-01T00:01:00+00:00',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ],
            'repo'           => RepoSample::serialized('octocatLinguist'),
            'installationId' => 1,
            'sender'         => SenderSample::serialized('octocat'),
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(EditedIssueCommentEvent::class);
    }
}
