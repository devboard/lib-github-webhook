<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\PullRequest;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestStatsSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestStatsTest
 */
class PullRequestStats
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

    public function __construct(int $additions, int $changedFiles, int $comments, int $commits, int $deletions)
    {
        $this->additions    = $additions;
        $this->changedFiles = $changedFiles;
        $this->comments     = $comments;
        $this->commits      = $commits;
        $this->deletions    = $deletions;
    }

    public function getAdditions(): int
    {
        return $this->additions;
    }

    public function getChangedFiles(): int
    {
        return $this->changedFiles;
    }

    public function getComments(): int
    {
        return $this->comments;
    }

    public function getCommits(): int
    {
        return $this->commits;
    }

    public function getDeletions(): int
    {
        return $this->deletions;
    }

    public function serialize(): array
    {
        return [
            'additions'    => $this->additions,
            'changedFiles' => $this->changedFiles,
            'comments'     => $this->comments,
            'commits'      => $this->commits,
            'deletions'    => $this->deletions,
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            $data['additions'], $data['changedFiles'], $data['comments'], $data['commits'], $data['deletions']
        );
    }
}
