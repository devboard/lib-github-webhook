<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Status;

use DevboardLib\Git\Branch\BranchName;
use Webmozart\Assert\Assert;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\Status\BranchNameCollectionSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\Status\BranchNameCollectionTest
 */
class BranchNameCollection
{
    /** @var array|BranchName[] */
    private $elements;

    /**
     * @param BranchName[] $elements
     */
    public function __construct(array $elements = [])
    {
        Assert::allIsInstanceOf($elements, BranchName::class);
        $this->elements = $elements;
    }

    public function add(BranchName $element)
    {
        $this->elements[] = $element;
    }

    public function has(string $id): bool
    {
        foreach ($this->elements as $element) {
            if ($element->getValue() == $id) {
                return true;
            }
        }

        return false;
    }

    public function get(string $id)
    {
        foreach ($this->elements as $element) {
            if ($element->getValue() == $id) {
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
            $elements[] = BranchName::deserialize($item);
        }

        return new self($elements);
    }
}
