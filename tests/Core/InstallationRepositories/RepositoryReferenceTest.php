<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\InstallationRepositories;

use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHub\Repo\RepoName;
use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReference;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReference
 * @group  unit
 */
class RepositoryReferenceTest extends TestCase
{
    /** @var RepoId */
    private $id;

    /** @var RepoFullName */
    private $fullName;

    /** @var RepositoryReference */
    private $sut;

    public function setUp(): void
    {
        $this->id       = new RepoId(64778136);
        $this->fullName = new RepoFullName(new AccountLogin('value'), new RepoName('name'));
        $this->sut      = new RepositoryReference($this->id, $this->fullName);
    }

    public function testGetId(): void
    {
        self::assertSame($this->id, $this->sut->getId());
    }

    public function testGetFullName(): void
    {
        self::assertSame($this->fullName, $this->sut->getFullName());
    }

    public function testSerialize(): void
    {
        $expected = ['id' => 64778136, 'fullName' => ['owner' => 'value', 'repoName' => 'name']];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, RepositoryReference::deserialize(json_decode($serialized, true)));
    }
}
