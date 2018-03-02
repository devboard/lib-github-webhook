<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\PullRequest;

use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use DevboardLib\Git\Branch\BranchName;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestBase;
use DevboardLib\GitHubWebhook\Core\Repo;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestBase
 * @group  unit
 */
class PullRequestBaseTest extends TestCase
{
    /** @var BranchName */
    private $targetBranchName;

    /** @var Repo */
    private $repo;

    /** @var CommitSha */
    private $sha;

    /** @var PullRequestBase */
    private $sut;

    public function setUp()
    {
        $this->targetBranchName = new BranchName('name');
        $this->repo             = RepoSample::octocatLinguist();
        $this->sha              = new CommitSha('sha');
        $this->sut              = new PullRequestBase($this->targetBranchName, $this->repo, $this->sha);
    }

    public function testGetTargetBranchName()
    {
        self::assertSame($this->targetBranchName, $this->sut->getTargetBranchName());
    }

    public function testGetRepo()
    {
        self::assertSame($this->repo, $this->sut->getRepo());
    }

    public function testGetSha()
    {
        self::assertSame($this->sha, $this->sut->getSha());
    }

    public function testSerialize()
    {
        $expected = [
            'targetBranchName' => 'name',
            'repo'             => RepoSample::serialized('octocatLinguist'),
            'sha'              => 'sha',
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, PullRequestBase::deserialize(json_decode($serialized, true)));
    }
}
