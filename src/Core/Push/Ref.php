<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Push;

use Webmozart\Assert\Assert;

/**
 * @see RefSpec
 * @see RefTest
 */
class Ref
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        Assert::regex($value, '#^refs\/(heads|tags)\/.*#');

        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function isBranchReference(): bool
    {
        if (1 === preg_match('#^refs\/heads\/#', $this->value)) {
            return true;
        }

        return false;
    }

    public function isTagReference(): bool
    {
        if (1 === preg_match('#^refs\/tags\/#', $this->value)) {
            return true;
        }

        return false;
    }

    public function getReferenceName(): string
    {
        if (1 === preg_match('#^refs\/(heads|tags)\/(?<name>.*)#', $this->value, $matches)) {
            return $matches['name'];
        }
    }

    public function serialize(): string
    {
        return $this->value;
    }

    public static function deserialize(string $value): self
    {
        return new self($value);
    }
}
