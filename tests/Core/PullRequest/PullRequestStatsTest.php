<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestStats;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestStats
 * @group  unit
 */
class PullRequestStatsTest extends TestCase
{
    /** @var int */
    private $additions;

    /** @var int */
    private $changedFiles;

    /** @var int */
    private $comments;

    /** @var int */
    private $commits;

    /** @var int */
    private $deletions;

    /** @var PullRequestStats */
    private $sut;

    public function setUp()
    {
        $this->additions    = 1;
        $this->changedFiles = 1;
        $this->comments     = 1;
        $this->commits      = 1;
        $this->deletions    = 1;
        $this->sut          = new PullRequestStats(
            $this->additions, $this->changedFiles, $this->comments, $this->commits, $this->deletions
        );
    }

    public function testGetAdditions()
    {
        self::assertSame($this->additions, $this->sut->getAdditions());
    }

    public function testGetChangedFiles()
    {
        self::assertSame($this->changedFiles, $this->sut->getChangedFiles());
    }

    public function testGetComments()
    {
        self::assertSame($this->comments, $this->sut->getComments());
    }

    public function testGetCommits()
    {
        self::assertSame($this->commits, $this->sut->getCommits());
    }

    public function testGetDeletions()
    {
        self::assertSame($this->deletions, $this->sut->getDeletions());
    }

    public function testSerialize()
    {
        $expected = ['additions' => 1, 'changedFiles' => 1, 'comments' => 1, 'commits' => 1, 'deletions' => 1];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, PullRequestStats::deserialize(json_decode($serialized, true)));
    }
}
