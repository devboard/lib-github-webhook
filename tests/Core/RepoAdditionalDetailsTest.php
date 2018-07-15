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

    public function setUp(): void
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

    public function testGetLicense(): void
    {
        self::assertSame($this->license, $this->sut->getLicense());
    }

    public function testGetForksCount(): void
    {
        self::assertSame($this->forksCount, $this->sut->getForksCount());
    }

    public function testIsHasDownloads(): void
    {
        self::assertSame($this->hasDownloads, $this->sut->isHasDownloads());
    }

    public function testIsHasIssues(): void
    {
        self::assertSame($this->hasIssues, $this->sut->isHasIssues());
    }

    public function testIsHasPages(): void
    {
        self::assertSame($this->hasPages, $this->sut->isHasPages());
    }

    public function testIsHasProjects(): void
    {
        self::assertSame($this->hasProjects, $this->sut->isHasProjects());
    }

    public function testIsHasWiki(): void
    {
        self::assertSame($this->hasWiki, $this->sut->isHasWiki());
    }

    public function testHasLicense(): void
    {
        self::assertTrue($this->sut->hasLicense());
    }

    public function testSerialize(): void
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

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, RepoAdditionalDetails::deserialize(json_decode($serialized, true)));
    }
}
