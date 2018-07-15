<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\PullRequest;

use Webmozart\Assert\Assert;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeamCollectionSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeamCollectionTest
 */
class PullRequestRequestedTeamCollection
{
    /** @var array|PullRequestRequestedTeam[] */
    private $elements;

    /**
     * @param PullRequestRequestedTeam[] $elements
     */
    public function __construct(array $elements = [])
    {
        Assert::allIsInstanceOf($elements, PullRequestRequestedTeam::class);
        $this->elements = $elements;
    }

    public function add(PullRequestRequestedTeam $element): void
    {
        $this->elements[] = $element;
    }

    public function has(string $id): bool
    {
        foreach ($this->elements as $element) {
            if ($element->getTodo() == $id) {
                return true;
            }
        }

        return false;
    }

    public function get(string $id): ?PullRequestRequestedTeam
    {
        foreach ($this->elements as $element) {
            if ($element->getTodo() == $id) {
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
            $elements[] = PullRequestRequestedTeam::deserialize($item);
        }

        return new self($elements);
    }
}
