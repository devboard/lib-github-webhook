<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Push;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\Push\CompareChangesUrlSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\Push\CompareChangesUrlTest
 */
class CompareChangesUrl
{
    /** @var string */
    private $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getId(): string
    {
        return $this->url;
    }

    public function __toString(): string
    {
        return $this->url;
    }

    public function serialize(): string
    {
        return $this->url;
    }

    public static function deserialize(string $url): self
    {
        return new self($url);
    }
}
