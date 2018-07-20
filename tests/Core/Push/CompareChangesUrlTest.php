<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\GitHubWebhook\Core\Push\CompareChangesUrl;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Push\CompareChangesUrl
 * @group  unit
 */
class CompareChangesUrlTest extends TestCase
{
    /** @var string */
    private $url;

    /** @var CompareChangesUrl */
    private $sut;

    public function setUp(): void
    {
        $this->url = 'url';
        $this->sut = new CompareChangesUrl($this->url);
    }

    public function testGetUrl(): void
    {
        self::assertSame($this->url, $this->sut->getUrl());
    }

    public function testGetId(): void
    {
        self::assertSame($this->url, $this->sut->getId());
    }

    public function testToString(): void
    {
        self::assertSame($this->url, $this->sut->asString());
    }

    public function testSerialize(): void
    {
        self::assertEquals($this->url, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        self::assertEquals($this->sut, $this->sut::deserialize($this->url));
    }
}
