<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\PullRequest;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeamSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeamTest
 */
class PullRequestRequestedTeam
{
    /** @var string */
    private $todo;

    public function __construct(string $todo)
    {
        $this->todo = $todo;
    }

    public function getTodo(): string
    {
        return $this->todo;
    }

    public function serialize(): string
    {
        return $this->todo;
    }

    public static function deserialize(string $todo): self
    {
        return new self($todo);
    }
}
