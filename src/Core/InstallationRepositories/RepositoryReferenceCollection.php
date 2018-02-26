<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\InstallationRepositories;

use DevboardLib\GitHub\Repo\RepoId;
use Webmozart\Assert\Assert;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReferenceCollectionSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReferenceCollectionTest
 */
class RepositoryReferenceCollection
{
    /** @var array|RepositoryReference[] */
    private $elements;

    /**
     * @param RepositoryReference[] $elements
     */
    public function __construct(array $elements = [])
    {
        Assert::allIsInstanceOf($elements, RepositoryReference::class);
        $this->elements = $elements;
    }

    public function add(RepositoryReference $element)
    {
        $this->elements[] = $element;
    }

    public function has(RepoId $id): bool
    {
        foreach ($this->elements as $element) {
            if ($element->getId() == $id) {
                return true;
            }
        }

        return false;
    }

    public function get(RepoId $id)
    {
        foreach ($this->elements as $element) {
            if ($element->getId() == $id) {
                return $element;
            }
        }

        return null;
    }

    public function toArray(): array
    {
        return $this->elements;
    }

    public function count(): int
    {
        return count($this->elements);
    }

    public function serialize(): array
    {
        $data = [];
        foreach ($this->elements as $element) {
            $data[] = $element->serialize();
        }

        return $data;
    }

    public static function deserialize(array $data): self
    {
        $elements = [];
        foreach ($data as $item) {
            $elements[] = RepositoryReference::deserialize($item);
        }

        return new self($elements);
    }
}
