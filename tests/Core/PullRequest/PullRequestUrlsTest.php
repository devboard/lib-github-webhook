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

    public function setUp(): void
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

    public function testGetCommentsUrl(): void
    {
        self::assertSame($this->commentsUrl, $this->sut->getCommentsUrl());
    }

    public function testGetCommitsUrl(): void
    {
        self::assertSame($this->commitsUrl, $this->sut->getCommitsUrl());
    }

    public function testGetDiffUrl(): void
    {
        self::assertSame($this->diffUrl, $this->sut->getDiffUrl());
    }

    public function testGetIssueUrl(): void
    {
        self::assertSame($this->issueUrl, $this->sut->getIssueUrl());
    }

    public function testGetPatchUrl(): void
    {
        self::assertSame($this->patchUrl, $this->sut->getPatchUrl());
    }

    public function testGetReviewCommentUrl(): void
    {
        self::assertSame($this->reviewCommentUrl, $this->sut->getReviewCommentUrl());
    }

    public function testGetReviewCommentsUrl(): void
    {
        self::assertSame($this->reviewCommentsUrl, $this->sut->getReviewCommentsUrl());
    }

    public function testGetStatusesUrl(): void
    {
        self::assertSame($this->statusesUrl, $this->sut->getStatusesUrl());
    }

    public function testSerialize(): void
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

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, PullRequestUrls::deserialize(json_decode($serialized, true)));
    }
}
