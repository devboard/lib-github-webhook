<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Push;

use Data\DevboardLib\GitHubWebhook\Core\Push\CommitAuthorSample;
use Data\DevboardLib\GitHubWebhook\Core\Push\CommitCommitterSample;
use DevboardLib\Git\Commit\CommitDate;
use DevboardLib\Git\Commit\CommitMessage;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\Git\Commit\CommitTree;
use DevboardLib\GitHubWebhook\Core\Push\Commit;
use DevboardLib\GitHubWebhook\Core\Push\CommitAuthor;
use DevboardLib\GitHubWebhook\Core\Push\CommitCommitter;
use PhpSpec\ObjectBehavior;

class CommitSpec extends ObjectBehavior
{
    public function let(
        CommitSha $sha,
        CommitMessage $message,
        CommitDate $commitDate,
        CommitAuthor $author,
        CommitCommitter $committer,
        CommitTree $tree
    ) {
        $this->beConstructedWith(
            $sha,
            $message,
            $commitDate,
            $author,
            $committer,
            $tree,
            $distinct = true,
            $addedFiles = ['data'],
            $modifiedFiles = ['data'],
            $removedFiles = ['data']
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

    public function it_exposes_is_distinct()
    {
        $this->isDisctinct()->shouldReturn(true);
    }

    public function it_exposes_added_files()
    {
        $this->getAddedFiles()->shouldReturn(['data']);
    }

    public function it_exposes_modified_files()
    {
        $this->getModifiedFiles()->shouldReturn(['data']);
    }

    public function it_exposes_removed_files()
    {
        $this->getRemovedFiles()->shouldReturn(['data']);
    }

    public function it_can_be_serialized(
        CommitSha $sha,
        CommitMessage $message,
        CommitDate $commitDate,
        CommitAuthor $author,
        CommitCommitter $committer,
        CommitTree $tree
    ) {
        $sha->serialize()->shouldBeCalled()->willReturn('sha');
        $message->serialize()->shouldBeCalled()->willReturn('message');
        $commitDate->serialize()->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $author->serialize()->shouldBeCalled()->willReturn(CommitAuthorSample::serialized('octocat'));
        $committer->serialize()->shouldBeCalled()->willReturn(CommitCommitterSample::serialized('octocat'));
        $tree->serialize()->shouldBeCalled()->willReturn('sha');
        $this->serialize()->shouldReturn(
            [
                'sha'           => 'sha',
                'message'       => 'message',
                'commitDate'    => '2018-01-01T00:01:00+00:00',
                'author'        => CommitAuthorSample::serialized('octocat'),
                'committer'     => CommitCommitterSample::serialized('octocat'),
                'tree'          => 'sha',
                'distinct'      => true,
                'addedFiles'    => ['data'],
                'modifiedFiles' => ['data'],
                'removedFiles'  => ['data'],
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'sha'           => 'sha',
            'message'       => 'message',
            'commitDate'    => '2018-01-01T00:01:00+00:00',
            'author'        => CommitAuthorSample::serialized('octocat'),
            'committer'     => CommitCommitterSample::serialized('octocat'),
            'tree'          => 'sha',
            'distinct'      => true,
            'addedFiles'    => ['data'],
            'modifiedFiles' => ['data'],
            'removedFiles'  => ['data'],
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(Commit::class);
    }
}
