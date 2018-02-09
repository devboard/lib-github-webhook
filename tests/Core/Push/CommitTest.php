<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Push;

use Data\DevboardLib\GitHubWebhook\Core\Push\CommitAuthorSample;
use Data\DevboardLib\GitHubWebhook\Core\Push\CommitCommitterSample;
use DevboardLib\Git\Commit\CommitDate;
use DevboardLib\Git\Commit\CommitMessage;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\Git\Commit\CommitTree;
use DevboardLib\GitHub\Commit\CommitHtmlUrl;
use DevboardLib\GitHubWebhook\Core\Push\Commit;
use DevboardLib\GitHubWebhook\Core\Push\CommitAuthor;
use DevboardLib\GitHubWebhook\Core\Push\CommitCommitter;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @covers \DevboardLib\GitHubWebhook\Core\Push\Commit
 * @group  unit
 */
class CommitTest extends TestCase
{
    /** @var CommitSha */
    private $sha;

    /** @var CommitMessage */
    private $message;

    /** @var CommitDate */
    private $commitDate;

    /** @var CommitAuthor */
    private $author;

    /** @var CommitCommitter */
    private $committer;

    /** @var CommitTree */
    private $tree;

    /** @var CommitHtmlUrl */
    private $htmlUrl;

    /** @var bool */
    private $distinct;

    /** @var array */
    private $addedFiles;

    /** @var array */
    private $modifiedFiles;

    /** @var array */
    private $removedFiles;

    /** @var Commit */
    private $sut;

    public function setUp()
    {
        $this->sha           = new CommitSha('sha');
        $this->message       = new CommitMessage('message');
        $this->commitDate    = new CommitDate('2018-01-01T00:01:00+00:00');
        $this->author        = CommitAuthorSample::octocat();
        $this->committer     = CommitCommitterSample::octocat();
        $this->tree          = new CommitTree(new CommitSha('sha'));
        $this->htmlUrl       = new CommitHtmlUrl('htmlUrl');
        $this->distinct      = true;
        $this->addedFiles    = ['data'];
        $this->modifiedFiles = ['data'];
        $this->removedFiles  = ['data'];
        $this->sut           = new Commit(
            $this->sha,
            $this->message,
            $this->commitDate,
            $this->author,
            $this->committer,
            $this->tree,
            $this->htmlUrl,
            $this->distinct,
            $this->addedFiles,
            $this->modifiedFiles,
            $this->removedFiles
        );
    }

    public function testGetSha()
    {
        self::assertSame($this->sha, $this->sut->getSha());
    }

    public function testGetMessage()
    {
        self::assertSame($this->message, $this->sut->getMessage());
    }

    public function testGetCommitDate()
    {
        self::assertSame($this->commitDate, $this->sut->getCommitDate());
    }

    public function testGetAuthor()
    {
        self::assertSame($this->author, $this->sut->getAuthor());
    }

    public function testGetCommitter()
    {
        self::assertSame($this->committer, $this->sut->getCommitter());
    }

    public function testGetTree()
    {
        self::assertSame($this->tree, $this->sut->getTree());
    }

    public function testGetHtmlUrl()
    {
        self::assertSame($this->htmlUrl, $this->sut->getHtmlUrl());
    }

    public function testIsDisctinct()
    {
        self::assertSame($this->distinct, $this->sut->isDisctinct());
    }

    public function testGetAddedFiles()
    {
        self::assertSame($this->addedFiles, $this->sut->getAddedFiles());
    }

    public function testGetModifiedFiles()
    {
        self::assertSame($this->modifiedFiles, $this->sut->getModifiedFiles());
    }

    public function testGetRemovedFiles()
    {
        self::assertSame($this->removedFiles, $this->sut->getRemovedFiles());
    }

    public function testSerialize()
    {
        $expected = [
            'sha'           => 'sha',
            'message'       => 'message',
            'commitDate'    => '2018-01-01T00:01:00+00:00',
            'author'        => CommitAuthorSample::serialized('octocat'),
            'committer'     => CommitCommitterSample::serialized('octocat'),
            'tree'          => 'sha',
            'htmlUrl'       => 'htmlUrl',
            'distinct'      => true,
            'addedFiles'    => ['data'],
            'modifiedFiles' => ['data'],
            'removedFiles'  => ['data'],
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, Commit::deserialize(json_decode($serialized, true)));
    }
}
