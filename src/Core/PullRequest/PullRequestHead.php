<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\Git\Branch\BranchName;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHubWebhook\Core\Repo;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestHeadSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestHeadTest
 */
class PullRequestHead
{
    /** @var BranchName */
    private $sourceBranchName;

    /** @var Repo|null */
    private $repo;

    /** @var CommitSha */
    private $sha;

    public function __construct(BranchName $sourceBranchName, ?Repo $repo, CommitSha $sha)
    {
        $this->sourceBranchName = $sourceBranchName;
        $this->repo             = $repo;
        $this->sha              = $sha;
    }

    public function getSourceBranchName(): BranchName
    {
        return $this->sourceBranchName;
    }

    public function getRepo(): ?Repo
    {
        return $this->repo;
    }

    public function getSha(): CommitSha
    {
        return $this->sha;
    }

    public function hasRepo(): bool
    {
        if (null === $this->repo) {
            return false;
        }

        return true;
    }

    public function serialize(): array
    {
        if (null === $this->repo) {
            $repo = null;
        } else {
            $repo = $this->repo->serialize();
        }

        return [
            'sourceBranchName' => $this->sourceBranchName->serialize(),
            'repo'             => $repo,
            'sha'              => $this->sha->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        if (null === $data['repo']) {
            $repo = null;
        } else {
            $repo = Repo::deserialize($data['repo']);
        }

        return new self(
            BranchName::deserialize($data['sourceBranchName']), $repo, CommitSha::deserialize($data['sha'])
        );
    }
}
