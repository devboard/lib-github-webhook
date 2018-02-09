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

    public function setUp()
    {
        $this->url = 'url';
        $this->sut = new CompareChangesUrl($this->url);
    }

    public function testGetUrl()
    {
        self::assertSame($this->url, $this->sut->getUrl());
    }

    public function testGetId()
    {
        self::assertSame($this->url, $this->sut->getId());
    }

    public function testToString()
    {
        self::assertSame($this->url, $this->sut->__toString());
    }

    public function testSerialize()
    {
        self::assertEquals($this->url, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        self::assertEquals($this->sut, $this->sut->deserialize($this->url));
    }
}
