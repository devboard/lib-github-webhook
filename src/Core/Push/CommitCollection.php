<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Git\Commit\CommitSha;
use Webmozart\Assert\Assert;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\Push\CommitCollectionSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\Push\CommitCollectionTest
 */
class CommitCollection
{
    /** @var array|Commit[] */
    private $elements;

    /**
     * @param Commit[] $elements
     */
    public function __construct(array $elements = [])
    {
        Assert::allIsInstanceOf($elements, Commit::class);
        $this->elements = $elements;
    }

    public function add(Commit $element): void
    {
        $this->elements[] = $element;
    }

    public function has(CommitSha $id): bool
    {
        foreach ($this->elements as $element) {
            if ($element->getSha() == $id) {
                return true;
            }
        }

        return false;
    }

    public function get(CommitSha $id): ?Commit
    {
        foreach ($this->elements as $element) {
            if ($element->getSha() == $id) {
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
            $elements[] = Commit::deserialize($item);
        }

        return new self($elements);
    }
}
