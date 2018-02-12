<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\RepoAdditionalDetails;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\RepoAdditionalDetails
 * @group  unit
 */
class RepoAdditionalDetailsTest extends TestCase
{
    /** @var string|null */
    private $license;

    /** @var int */
    private $forksCount;

    /** @var bool */
    private $hasDownloads;

    /** @var bool */
    private $hasIssues;

    /** @var bool */
    private $hasPages;

    /** @var bool */
    private $hasProjects;

    /** @var bool */
    private $hasWiki;

    /** @var RepoAdditionalDetails */
    private $sut;

    public function setUp()
    {
        $this->license      = 'master';
        $this->forksCount   = 0;
        $this->hasDownloads = false;
        $this->hasIssues    = false;
        $this->hasPages     = false;
        $this->hasProjects  = false;
        $this->hasWiki      = false;
        $this->sut          = new RepoAdditionalDetails(
            $this->license,
            $this->forksCount,
            $this->hasDownloads,
            $this->hasIssues,
            $this->hasPages,
            $this->hasProjects,
            $this->hasWiki
        );
    }

    public function testGetLicense()
    {
        self::assertSame($this->license, $this->sut->getLicense());
    }

    public function testGetForksCount()
    {
        self::assertSame($this->forksCount, $this->sut->getForksCount());
    }

    public function testIsHasDownloads()
    {
        self::assertSame($this->hasDownloads, $this->sut->isHasDownloads());
    }

    public function testIsHasIssues()
    {
        self::assertSame($this->hasIssues, $this->sut->isHasIssues());
    }

    public function testIsHasPages()
    {
        self::assertSame($this->hasPages, $this->sut->isHasPages());
    }

    public function testIsHasProjects()
    {
        self::assertSame($this->hasProjects, $this->sut->isHasProjects());
    }

    public function testIsHasWiki()
    {
        self::assertSame($this->hasWiki, $this->sut->isHasWiki());
    }

    public function testHasLicense()
    {
        self::assertTrue($this->sut->hasLicense());
    }

    public function testSerialize()
    {
        $expected = [
            'license'      => 'master',
            'forksCount'   => 0,
            'hasDownloads' => false,
            'hasIssues'    => false,
            'hasPages'     => false,
            'hasProjects'  => false,
            'hasWiki'      => false,
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, RepoAdditionalDetails::deserialize(json_decode($serialized, true)));
    }
}
