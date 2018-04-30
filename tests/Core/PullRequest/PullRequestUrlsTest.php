<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestUrls;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestUrls
 * @group  unit
 */
class PullRequestUrlsTest extends TestCase
{
    /** @var string */
    private $commentsUrl;

    /** @var string */
    private $commitsUrl;

    /** @var string */
    private $diffUrl;

    /** @var string */
    private $issueUrl;

    /** @var string */
    private $patchUrl;

    /** @var string */
    private $reviewCommentUrl;

    /** @var string */
    private $reviewCommentsUrl;

    /** @var string */
    private $statusesUrl;

    /** @var PullRequestUrls */
    private $sut;

    public function setUp()
    {
        $this->commentsUrl       = 'commentsUrl';
        $this->commitsUrl        = 'commitsUrl';
        $this->diffUrl           = 'diffUrl';
        $this->issueUrl          = 'issueUrl';
        $this->patchUrl          = 'patchUrl';
        $this->reviewCommentUrl  = 'reviewCommentUrl';
        $this->reviewCommentsUrl = 'reviewCommentsUrl';
        $this->statusesUrl       = 'statusesUrl';
        $this->sut               = new PullRequestUrls(
            $this->commentsUrl,
            $this->commitsUrl,
            $this->diffUrl,
            $this->issueUrl,
            $this->patchUrl,
            $this->reviewCommentUrl,
            $this->reviewCommentsUrl,
            $this->statusesUrl
        );
    }

    public function testGetCommentsUrl()
    {
        self::assertSame($this->commentsUrl, $this->sut->getCommentsUrl());
    }

    public function testGetCommitsUrl()
    {
        self::assertSame($this->commitsUrl, $this->sut->getCommitsUrl());
    }

    public function testGetDiffUrl()
    {
        self::assertSame($this->diffUrl, $this->sut->getDiffUrl());
    }

    public function testGetIssueUrl()
    {
        self::assertSame($this->issueUrl, $this->sut->getIssueUrl());
    }

    public function testGetPatchUrl()
    {
        self::assertSame($this->patchUrl, $this->sut->getPatchUrl());
    }

    public function testGetReviewCommentUrl()
    {
        self::assertSame($this->reviewCommentUrl, $this->sut->getReviewCommentUrl());
    }

    public function testGetReviewCommentsUrl()
    {
        self::assertSame($this->reviewCommentsUrl, $this->sut->getReviewCommentsUrl());
    }

    public function testGetStatusesUrl()
    {
        self::assertSame($this->statusesUrl, $this->sut->getStatusesUrl());
    }

    public function testSerialize()
    {
        $expected = [
            'commentsUrl'       => 'commentsUrl',
            'commitsUrl'        => 'commitsUrl',
            'diffUrl'           => 'diffUrl',
            'issueUrl'          => 'issueUrl',
            'patchUrl'          => 'patchUrl',
            'reviewCommentUrl'  => 'reviewCommentUrl',
            'reviewCommentsUrl' => 'reviewCommentsUrl',
            'statusesUrl'       => 'statusesUrl',
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, PullRequestUrls::deserialize(json_decode($serialized, true)));
    }
}
