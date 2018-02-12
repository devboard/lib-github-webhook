<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\RepoAdditionalDetailsSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\RepoAdditionalDetailsTest
 */
class RepoAdditionalDetails
{
    /** @var string|null */
    private $license;

    /** @var int */
    private $forksCount;

    /** @var bool */
    private $hasDownloads;

    /** @var bool */
    private $hasIssues;

    /** @var bool */
    private $hasPages;

    /** @var bool */
    private $hasProjects;

    /** @var bool */
    private $hasWiki;

    public function __construct(
        ?string $license,
        int $forksCount,
        bool $hasDownloads,
        bool $hasIssues,
        bool $hasPages,
        bool $hasProjects,
        bool $hasWiki
    ) {
        $this->license      = $license;
        $this->forksCount   = $forksCount;
        $this->hasDownloads = $hasDownloads;
        $this->hasIssues    = $hasIssues;
        $this->hasPages     = $hasPages;
        $this->hasProjects  = $hasProjects;
        $this->hasWiki      = $hasWiki;
    }

    public function getLicense(): ?string
    {
        return $this->license;
    }

    public function getForksCount(): int
    {
        return $this->forksCount;
    }

    public function isHasDownloads(): bool
    {
        return $this->hasDownloads;
    }

    public function isHasIssues(): bool
    {
        return $this->hasIssues;
    }

    public function isHasPages(): bool
    {
        return $this->hasPages;
    }

    public function isHasProjects(): bool
    {
        return $this->hasProjects;
    }

    public function isHasWiki(): bool
    {
        return $this->hasWiki;
    }

    public function hasLicense(): bool
    {
        if (null === $this->license) {
            return false;
        }

        return true;
    }

    public function serialize(): array
    {
        return [
            'license'      => $this->license,
            'forksCount'   => $this->forksCount,
            'hasDownloads' => $this->hasDownloads,
            'hasIssues'    => $this->hasIssues,
            'hasPages'     => $this->hasPages,
            'hasProjects'  => $this->hasProjects,
            'hasWiki'      => $this->hasWiki,
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            $data['license'],
            $data['forksCount'],
            $data['hasDownloads'],
            $data['hasIssues'],
            $data['hasPages'],
            $data['hasProjects'],
            $data['hasWiki']
        );
    }
}
