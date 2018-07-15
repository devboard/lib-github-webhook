<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Push;

use Data\DevboardLib\GitHubWebhook\Core\Push\CommitSample;
use DevboardLib\GitHubWebhook\Core\Push\CommitCollection;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Push\CommitCollection
 * @group  unit
 */
class CommitCollectionTest extends TestCase
{
    /** @var array */
    private $elements = [];

    /** @var CommitCollection */
    private $sut;

    public function setUp(): void
    {
        $this->elements = [CommitSample::abc123()];
        $this->sut      = new CommitCollection($this->elements);
    }

    public function testGetElements(): void
    {
        self::assertSame($this->elements, $this->sut->toArray());
    }

    public function testSerializeAndDeserialize(): void
    {
        $serialized     = $this->sut->serialize();
        $serializedJson = json_encode($serialized);
        self::assertEquals($this->sut, $this->sut->deserialize(json_decode($serializedJson, true)));
    }
}
