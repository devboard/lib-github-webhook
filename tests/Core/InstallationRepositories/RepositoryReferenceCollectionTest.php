<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\InstallationRepositories;

use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHub\Repo\RepoName;
use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReference;
use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReferenceCollection;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReferenceCollection
 * @group  unit
 */
class RepositoryReferenceCollectionTest extends TestCase
{
    /** @var array */
    private $elements = [];

    /** @var RepositoryReferenceCollection */
    private $sut;

    public function setUp(): void
    {
        $this->elements = [
            new RepositoryReference(new RepoId(1), new RepoFullName(new AccountLogin('value'), new RepoName('name'))),
        ];
        $this->sut = new RepositoryReferenceCollection($this->elements);
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
