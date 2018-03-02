<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\Git\Branch\BranchName;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHubWebhook\Core\Repo;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestBaseSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestBaseTest
 */
class PullRequestBase
{
    /** @var BranchName */
    private $targetBranchName;

    /** @var Repo */
    private $repo;

    /** @var CommitSha */
    private $sha;

    public function __construct(BranchName $targetBranchName, Repo $repo, CommitSha $sha)
    {
        $this->targetBranchName = $targetBranchName;
        $this->repo             = $repo;
        $this->sha              = $sha;
    }

    public function getTargetBranchName(): BranchName
    {
        return $this->targetBranchName;
    }

    public function getRepo(): Repo
    {
        return $this->repo;
    }

    public function getSha(): CommitSha
    {
        return $this->sha;
    }

    public function serialize(): array
    {
        return [
            'targetBranchName' => $this->targetBranchName->serialize(),
            'repo'             => $this->repo->serialize(),
            'sha'              => $this->sha->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            BranchName::deserialize($data['targetBranchName']),
            Repo::deserialize($data['repo']),
            CommitSha::deserialize($data['sha'])
        );
    }
}
