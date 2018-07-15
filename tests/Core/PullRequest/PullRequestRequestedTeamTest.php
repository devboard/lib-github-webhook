<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeam;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeam
 * @group  unit
 */
class PullRequestRequestedTeamTest extends TestCase
{
    /** @var string */
    private $todo;

    /** @var PullRequestRequestedTeam */
    private $sut;

    public function setUp(): void
    {
        $this->todo = 'todo';
        $this->sut  = new PullRequestRequestedTeam($this->todo);
    }

    public function testGetTodo(): void
    {
        self::assertSame($this->todo, $this->sut->getTodo());
    }

    public function testSerialize(): void
    {
        self::assertEquals($this->todo, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        self::assertEquals($this->sut, $this->sut->deserialize($this->todo));
    }
}
