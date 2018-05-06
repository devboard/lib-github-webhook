<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Status;

use Data\DevboardLib\GitHubWebhook\Core\Status\CommitAuthorSample;
use Data\DevboardLib\GitHubWebhook\Core\Status\CommitCommitterSample;
use DevboardLib\Git\Commit\CommitDate;
use DevboardLib\Git\Commit\CommitMessage;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHub\Commit\CommitParent;
use DevboardLib\GitHub\Commit\CommitParentCollection;
use DevboardLib\GitHub\Commit\CommitTree;
use DevboardLib\GitHub\Commit\CommitVerification;
use DevboardLib\GitHub\Commit\Verification\VerificationPayload;
use DevboardLib\GitHub\Commit\Verification\VerificationReason;
use DevboardLib\GitHub\Commit\Verification\VerificationSignature;
use DevboardLib\GitHub\Commit\Verification\VerificationVerified;
use DevboardLib\GitHubWebhook\Core\Status\Commit;
use DevboardLib\GitHubWebhook\Core\Status\CommitAuthor;
use DevboardLib\GitHubWebhook\Core\Status\CommitCommitter;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @covers \DevboardLib\GitHubWebhook\Core\Status\Commit
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

    /** @var CommitParentCollection */
    private $parents;

    /** @var CommitVerification */
    private $verification;

    /** @var string */
    private $commentsUrl;

    /** @var Commit */
    private $sut;

    public function setUp()
    {
        $this->sha          = new CommitSha('sha');
        $this->message      = new CommitMessage('message');
        $this->commitDate   = new CommitDate('2018-01-01T00:01:00+00:00');
        $this->author       = CommitAuthorSample::octocat();
        $this->committer    = CommitCommitterSample::octocat();
        $this->tree         = new CommitTree(new CommitSha('sha'));
        $this->parents      = new CommitParentCollection([new CommitParent(new CommitSha('sha'))]);
        $this->verification = new CommitVerification(
            new VerificationVerified(true),
            new VerificationReason('reason'),
            new VerificationSignature('signature'),
            new VerificationPayload('payload')
        );

        $this->commentsUrl = 'commentsUrl';
        $this->sut         = new Commit(
            $this->sha,
            $this->message,
            $this->commitDate,
            $this->author,
            $this->committer,
            $this->tree,
            $this->parents,
            $this->verification,
            $this->commentsUrl
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

    public function testGetParents()
    {
        self::assertSame($this->parents, $this->sut->getParents());
    }

    public function testGetVerification()
    {
        self::assertSame($this->verification, $this->sut->getVerification());
    }

    public function testGetCommentsUrl()
    {
        self::assertSame($this->commentsUrl, $this->sut->getCommentsUrl());
    }

    public function testSerialize()
    {
        $expected = [
            'sha'          => 'sha',
            'message'      => 'message',
            'commitDate'   => '2018-01-01T00:01:00+00:00',
            'author'       => CommitAuthorSample::serialized('octocat'),
            'committer'    => CommitCommitterSample::serialized('octocat'),
            'tree'         => ['sha' => 'sha'],
            'parents'      => [['sha' => 'sha']],
            'verification' => [
                'verified'  => true,
                'reason'    => 'reason',
                'signature' => 'signature',
                'payload'   => 'payload',
            ],
            'commentsUrl' => 'commentsUrl',
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, Commit::deserialize(json_decode($serialized, true)));
    }
}
