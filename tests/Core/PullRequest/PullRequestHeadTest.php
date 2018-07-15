<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\PullRequest;

use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use DevboardLib\Git\Branch\BranchName;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestHead;
use DevboardLib\GitHubWebhook\Core\Repo;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestHead
 * @group  unit
 */
class PullRequestHeadTest extends TestCase
{
    /** @var BranchName */
    private $sourceBranchName;

    /** @var Repo */
    private $repo;

    /** @var CommitSha */
    private $sha;

    /** @var PullRequestHead */
    private $sut;

    public function setUp(): void
    {
        $this->sourceBranchName = new BranchName('name');
        $this->repo             = RepoSample::octocatLinguist();
        $this->sha              = new CommitSha('sha');
        $this->sut              = new PullRequestHead($this->sourceBranchName, $this->repo, $this->sha);
    }

    public function testGetSourceBranchName(): void
    {
        self::assertSame($this->sourceBranchName, $this->sut->getSourceBranchName());
    }

    public function testGetRepo(): void
    {
        self::assertSame($this->repo, $this->sut->getRepo());
    }

    public function testGetSha(): void
    {
        self::assertSame($this->sha, $this->sut->getSha());
    }

    public function testSerialize(): void
    {
        $expected = [
            'sourceBranchName' => 'name',
            'repo'             => RepoSample::serialized('octocatLinguist'),
            'sha'              => 'sha',
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, PullRequestHead::deserialize(json_decode($serialized, true)));
    }
}
