<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeam;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeamCollection;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeamCollection
 * @group  unit
 */
class PullRequestRequestedTeamCollectionTest extends TestCase
{
    /** @var array */
    private $elements = [];

    /** @var PullRequestRequestedTeamCollection */
    private $sut;

    public function setUp()
    {
        $this->elements = [new PullRequestRequestedTeam('todo')];
        $this->sut      = new PullRequestRequestedTeamCollection($this->elements);
    }

    public function testGetElements()
    {
        self::assertSame($this->elements, $this->sut->toArray());
    }

    public function testSerializeAndDeserialize()
    {
        $serialized     = $this->sut->serialize();
        $serializedJson = json_encode($serialized);
        self::assertEquals($this->sut, $this->sut->deserialize(json_decode($serializedJson, true)));
    }
}
