<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Issue;

use DevboardLib\GitHub\Account\AccountId;
use Webmozart\Assert\Assert;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\Issue\IssueAssigneeCollectionSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\Issue\IssueAssigneeCollectionTest
 */
class IssueAssigneeCollection
{
    /** @var array|IssueAssignee[] */
    private $elements;

    /**
     * @param IssueAssignee[] $elements
     */
    public function __construct(array $elements = [])
    {
        Assert::allIsInstanceOf($elements, IssueAssignee::class);
        $this->elements = $elements;
    }

    public function add(IssueAssignee $element):void
    {
        $this->elements[] = $element;
    }

    public function has(AccountId $id): bool
    {
        foreach ($this->elements as $element) {
            if ($element->getUserId() == $id) {
                return true;
            }
        }

        return false;
    }

    public function get(AccountId $id):?IssueAssignee
    {
        foreach ($this->elements as $element) {
            if ($element->getUserId() == $id) {
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
            $elements[] = IssueAssignee::deserialize($item);
        }

        return new self($elements);
    }
}
