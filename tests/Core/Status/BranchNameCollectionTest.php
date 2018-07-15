<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Status;

use DevboardLib\Git\Branch\BranchName;
use DevboardLib\GitHubWebhook\Core\Status\BranchNameCollection;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Status\BranchNameCollection
 * @group  unit
 */
class BranchNameCollectionTest extends TestCase
{
    /** @var array */
    private $elements = [];

    /** @var BranchNameCollection */
    private $sut;

    public function setUp(): void
    {
        $this->elements = [new BranchName('master')];
        $this->sut      = new BranchNameCollection($this->elements);
    }

    public function testGetElements(): void
    {
        self::assertSame($this->elements, $this->sut->toArray());
    }

    public function testSerializeAndDeserialize(): void
    {
        $serialized     = $this->sut->serialize();
        $serializedJson = json_encode($serialized);
        self::assertEquals($this->sut, $this->sut::deserialize(json_decode($serializedJson, true)));
    }
}
