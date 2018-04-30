<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Status;

use DevboardLib\Git\Commit\CommitDate;
use DevboardLib\Git\Commit\CommitMessage;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHub\Commit\CommitParentCollection;
use DevboardLib\GitHub\Commit\CommitTree;
use DevboardLib\GitHub\Commit\CommitVerification;
use DevboardLib\GitHubWebhook\Core\Status\Commit;
use DevboardLib\GitHubWebhook\Core\Status\CommitAuthor;
use DevboardLib\GitHubWebhook\Core\Status\CommitCommitter;
use PhpSpec\ObjectBehavior;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 */
class CommitSpec extends ObjectBehavior
{
    public function let(
        CommitSha $sha,
        CommitMessage $message,
        CommitDate $commitDate,
        CommitAuthor $author,
        CommitCommitter $committer,
        CommitTree $tree,
        CommitParentCollection $parents,
        CommitVerification $verification
    ) {
        $this->beConstructedWith(
            $sha,
            $message,
            $commitDate,
            $author,
            $committer,
            $tree,
            $parents,
            $verification,
            $commentsUrl = 'commentsUrl'
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Commit::class);
        $this->shouldImplement(Commit::class);
    }

    public function it_exposes_sha(CommitSha $sha)
    {
        $this->getSha()->shouldReturn($sha);
    }

    public function it_exposes_message(CommitMessage $message)
    {
        $this->getMessage()->shouldReturn($message);
    }

    public function it_exposes_commit_date(CommitDate $commitDate)
    {
        $this->getCommitDate()->shouldReturn($commitDate);
    }

    public function it_exposes_author(CommitAuthor $author)
    {
        $this->getAuthor()->shouldReturn($author);
    }

    public function it_exposes_committer(CommitCommitter $committer)
    {
        $this->getCommitter()->shouldReturn($committer);
    }

    public function it_exposes_tree(CommitTree $tree)
    {
        $this->getTree()->shouldReturn($tree);
    }

    public function it_exposes_parents(CommitParentCollection $parents)
    {
        $this->getParents()->shouldReturn($parents);
    }

    public function it_exposes_verification(CommitVerification $verification)
    {
        $this->getVerification()->shouldReturn($verification);
    }

    public function it_exposes_comments_url()
    {
        $this->getCommentsUrl()->shouldReturn('commentsUrl');
    }

    public function it_can_be_serialized(
        CommitSha $sha,
        CommitMessage $message,
        CommitDate $commitDate,
        CommitAuthor $author,
        CommitCommitter $committer,
        CommitTree $tree,
        CommitParentCollection $parents,
        CommitVerification $verification
    ) {
        $sha->serialize()->shouldBeCalled()->willReturn('sha');
        $message->serialize()->shouldBeCalled()->willReturn('message');
        $commitDate->serialize()->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $author->serialize()->shouldBeCalled()->willReturn(
            [
                'name'      => 'name',
                'email'     => 'octocat@example.com',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'details'   => [
                    'userId'            => 1,
                    'login'             => 'value',
                    'type'              => 'User',
                    'avatarUrl'         => 'avatarUrl',
                    'siteAdmin'         => true,
                    'eventsUrl'         => 'eventsUrl',
                    'followersUrl'      => 'followersUrl',
                    'followingUrl'      => 'followingUrl',
                    'gistsUrl'          => 'gistsUrl',
                    'organizationsUrl'  => 'organizationsUrl',
                    'receivedEventsUrl' => 'receivedEventsUrl',
                    'reposUrl'          => 'reposUrl',
                    'starredUrl'        => 'starredUrl',
                    'subscriptionsUrl'  => 'subscriptionsUrl',
                ],
            ]
        );
        $committer->serialize()->shouldBeCalled()->willReturn(
            [
                'name'        => 'name',
                'email'       => 'octocat@example.com',
                'committedAt' => '2018-01-01T00:01:00+00:00',
                'details'     => [
                    'userId'            => 1,
                    'login'             => 'value',
                    'type'              => 'User',
                    'avatarUrl'         => 'avatarUrl',
                    'siteAdmin'         => true,
                    'eventsUrl'         => 'eventsUrl',
                    'followersUrl'      => 'followersUrl',
                    'followingUrl'      => 'followingUrl',
                    'gistsUrl'          => 'gistsUrl',
                    'organizationsUrl'  => 'organizationsUrl',
                    'receivedEventsUrl' => 'receivedEventsUrl',
                    'reposUrl'          => 'reposUrl',
                    'starredUrl'        => 'starredUrl',
                    'subscriptionsUrl'  => 'subscriptionsUrl',
                ],
            ]
        );
        $tree->serialize()->shouldBeCalled()->willReturn(['sha' => 'sha', 'apiUrl' => 'url']);
        $parents->serialize()->shouldBeCalled()->willReturn(
            [['sha' => 'sha', 'apiUrl' => 'apiUrl', 'htmlUrl' => 'htmlUrl']]
        );
        $verification->serialize()->shouldBeCalled()->willReturn(
            ['verified' => true, 'reason' => 'reason', 'signature' => 'signature', 'payload' => 'payload']
        );
        $this->serialize()->shouldReturn(
            [
                'sha'        => 'sha',
                'message'    => 'message',
                'commitDate' => '2018-01-01T00:01:00+00:00',
                'author'     => [
                    'name'      => 'name',
                    'email'     => 'octocat@example.com',
                    'createdAt' => '2018-01-01T00:01:00+00:00',
                    'details'   => [
                        'userId'            => 1,
                        'login'             => 'value',
                        'type'              => 'User',
                        'avatarUrl'         => 'avatarUrl',
                        'siteAdmin'         => true,
                        'eventsUrl'         => 'eventsUrl',
                        'followersUrl'      => 'followersUrl',
                        'followingUrl'      => 'followingUrl',
                        'gistsUrl'          => 'gistsUrl',
                        'organizationsUrl'  => 'organizationsUrl',
                        'receivedEventsUrl' => 'receivedEventsUrl',
                        'reposUrl'          => 'reposUrl',
                        'starredUrl'        => 'starredUrl',
                        'subscriptionsUrl'  => 'subscriptionsUrl',
                    ],
                ],
                'committer' => [
                    'name'        => 'name',
                    'email'       => 'octocat@example.com',
                    'committedAt' => '2018-01-01T00:01:00+00:00',
                    'details'     => [
                        'userId'            => 1,
                        'login'             => 'value',
                        'type'              => 'User',
                        'avatarUrl'         => 'avatarUrl',
                        'siteAdmin'         => true,
                        'eventsUrl'         => 'eventsUrl',
                        'followersUrl'      => 'followersUrl',
                        'followingUrl'      => 'followingUrl',
                        'gistsUrl'          => 'gistsUrl',
                        'organizationsUrl'  => 'organizationsUrl',
                        'receivedEventsUrl' => 'receivedEventsUrl',
                        'reposUrl'          => 'reposUrl',
                        'starredUrl'        => 'starredUrl',
                        'subscriptionsUrl'  => 'subscriptionsUrl',
                    ],
                ],
                'tree'         => ['sha' => 'sha', 'apiUrl' => 'url'],
                'parents'      => [['sha' => 'sha', 'apiUrl' => 'apiUrl', 'htmlUrl' => 'htmlUrl']],
                'verification' => [
                    'verified'  => true,
                    'reason'    => 'reason',
                    'signature' => 'signature',
                    'payload'   => 'payload',
                ],
                'commentsUrl' => 'commentsUrl',
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'sha'        => 'sha',
            'message'    => 'message',
            'commitDate' => '2018-01-01T00:01:00+00:00',
            'author'     => [
                'name'      => 'name',
                'email'     => 'octocat@example.com',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'details'   => [
                    'userId'            => 1,
                    'login'             => 'value',
                    'type'              => 'User',
                    'avatarUrl'         => 'avatarUrl',
                    'siteAdmin'         => true,
                    'eventsUrl'         => 'eventsUrl',
                    'followersUrl'      => 'followersUrl',
                    'followingUrl'      => 'followingUrl',
                    'gistsUrl'          => 'gistsUrl',
                    'organizationsUrl'  => 'organizationsUrl',
                    'receivedEventsUrl' => 'receivedEventsUrl',
                    'reposUrl'          => 'reposUrl',
                    'starredUrl'        => 'starredUrl',
                    'subscriptionsUrl'  => 'subscriptionsUrl',
                ],
            ],
            'committer' => [
                'name'        => 'name',
                'email'       => 'octocat@example.com',
                'committedAt' => '2018-01-01T00:01:00+00:00',
                'details'     => [
                    'userId'            => 1,
                    'login'             => 'value',
                    'type'              => 'User',
                    'avatarUrl'         => 'avatarUrl',
                    'siteAdmin'         => true,
                    'eventsUrl'         => 'eventsUrl',
                    'followersUrl'      => 'followersUrl',
                    'followingUrl'      => 'followingUrl',
                    'gistsUrl'          => 'gistsUrl',
                    'organizationsUrl'  => 'organizationsUrl',
                    'receivedEventsUrl' => 'receivedEventsUrl',
                    'reposUrl'          => 'reposUrl',
                    'starredUrl'        => 'starredUrl',
                    'subscriptionsUrl'  => 'subscriptionsUrl',
                ],
            ],
            'tree'         => ['sha' => 'sha', 'apiUrl' => 'url'],
            'parents'      => [['sha' => 'sha', 'apiUrl' => 'apiUrl', 'htmlUrl' => 'htmlUrl']],
            'verification' => [
                'verified'  => true,
                'reason'    => 'reason',
                'signature' => 'signature',
                'payload'   => 'payload',
            ],
            'commentsUrl' => 'commentsUrl',
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(Commit::class);
    }
}
