<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\PullRequestReview;

use DevboardLib\GitHub\PullRequest\PullRequestApiUrl;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewHtmlUrl;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReviewUrlsSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReviewUrlsTest
 */
class PullRequestReviewUrls
{
    /** @var PullRequestReviewHtmlUrl */
    private $htmlUrl;

    /** @var PullRequestApiUrl */
    private $pullRequestApiUrl;

    public function __construct(PullRequestReviewHtmlUrl $htmlUrl, PullRequestApiUrl $pullRequestApiUrl)
    {
        $this->htmlUrl           = $htmlUrl;
        $this->pullRequestApiUrl = $pullRequestApiUrl;
    }

    public function getHtmlUrl(): PullRequestReviewHtmlUrl
    {
        return $this->htmlUrl;
    }

    public function getValue(): PullRequestApiUrl
    {
        return $this->pullRequestApiUrl;
    }

    public function getPullRequestApiUrl(): PullRequestApiUrl
    {
        return $this->pullRequestApiUrl;
    }

    public function serialize(): array
    {
        return [
            'htmlUrl'           => $this->htmlUrl->serialize(),
            'pullRequestApiUrl' => $this->pullRequestApiUrl->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            PullRequestReviewHtmlUrl::deserialize($data['htmlUrl']),
            PullRequestApiUrl::deserialize($data['pullRequestApiUrl'])
        );
    }
}
