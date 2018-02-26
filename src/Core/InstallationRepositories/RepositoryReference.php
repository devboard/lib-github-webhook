<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\InstallationRepositories;

use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReferenceSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReferenceTest
 */
class RepositoryReference
{
    /** @var RepoId */
    private $id;

    /** @var RepoFullName */
    private $fullName;

    public function __construct(RepoId $id, RepoFullName $fullName)
    {
        $this->id       = $id;
        $this->fullName = $fullName;
    }

    public static function create(int $repoId, string $fullName): self
    {
        return new self(new RepoId($repoId), RepoFullName::createFromString($fullName));
    }

    public function getId(): RepoId
    {
        return $this->id;
    }

    public function getFullName(): RepoFullName
    {
        return $this->fullName;
    }

    public function serialize(): array
    {
        return ['id' => $this->id->serialize(), 'fullName' => $this->fullName->serialize()];
    }

    public static function deserialize(array $data): self
    {
        return new self(RepoId::deserialize($data['id']), RepoFullName::deserialize($data['fullName']));
    }
}
