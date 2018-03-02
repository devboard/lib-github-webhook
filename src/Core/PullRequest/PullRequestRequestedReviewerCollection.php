<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHub\User\UserId;
use Webmozart\Assert\Assert;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedReviewerCollectionSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedReviewerCollectionTest
 */
class PullRequestRequestedReviewerCollection
{
    /** @var array|PullRequestRequestedReviewer[] */
    private $elements;

    /**
     * @param PullRequestRequestedReviewer[] $elements
     */
    public function __construct(array $elements = [])
    {
        Assert::allIsInstanceOf($elements, PullRequestRequestedReviewer::class);
        $this->elements = $elements;
    }

    public function add(PullRequestRequestedReviewer $element)
    {
        $this->elements[] = $element;
    }

    public function has(UserId $id): bool
    {
        foreach ($this->elements as $element) {
            if ($element->getUserId() == $id) {
                return true;
            }
        }

        return false;
    }

    public function get(UserId $id)
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
            $elements[] = PullRequestRequestedReviewer::deserialize($item);
        }

        return new self($elements);
    }
}
