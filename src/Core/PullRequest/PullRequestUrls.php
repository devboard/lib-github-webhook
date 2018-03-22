<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHub\PullRequest\PullRequestApiUrl;
use DevboardLib\GitHub\PullRequest\PullRequestHtmlUrl;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestUrlsSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestUrlsTest
 */
class PullRequestUrls
{
    /** @var PullRequestApiUrl */
    private $apiUrl;

    /** @var PullRequestHtmlUrl */
    private $htmlUrl;

    /** @var string */
    private $commentsUrl;

    /** @var string */
    private $commitsUrl;

    /** @var string */
    private $diffUrl;

    /** @var string */
    private $issueUrl;

    /** @var string */
    private $patchUrl;

    /** @var string */
    private $reviewCommentUrl;

    /** @var string */
    private $reviewCommentsUrl;

    /** @var string */
    private $statusesUrl;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        PullRequestApiUrl $apiUrl,
        PullRequestHtmlUrl $htmlUrl,
        string $commentsUrl,
        string $commitsUrl,
        string $diffUrl,
        string $issueUrl,
        string $patchUrl,
        string $reviewCommentUrl,
        string $reviewCommentsUrl,
        string $statusesUrl
    ) {
        $this->apiUrl            = $apiUrl;
        $this->htmlUrl           = $htmlUrl;
        $this->commentsUrl       = $commentsUrl;
        $this->commitsUrl        = $commitsUrl;
        $this->diffUrl           = $diffUrl;
        $this->issueUrl          = $issueUrl;
        $this->patchUrl          = $patchUrl;
        $this->reviewCommentUrl  = $reviewCommentUrl;
        $this->reviewCommentsUrl = $reviewCommentsUrl;
        $this->statusesUrl       = $statusesUrl;
    }

    public function getApiUrl(): PullRequestApiUrl
    {
        return $this->apiUrl;
    }

    public function getHtmlUrl(): PullRequestHtmlUrl
    {
        return $this->htmlUrl;
    }

    public function getCommentsUrl(): string
    {
        return $this->commentsUrl;
    }

    public function getCommitsUrl(): string
    {
        return $this->commitsUrl;
    }

    public function getDiffUrl(): string
    {
        return $this->diffUrl;
    }

    public function getIssueUrl(): string
    {
        return $this->issueUrl;
    }

    public function getPatchUrl(): string
    {
        return $this->patchUrl;
    }

    public function getReviewCommentUrl(): string
    {
        return $this->reviewCommentUrl;
    }

    public function getReviewCommentsUrl(): string
    {
        return $this->reviewCommentsUrl;
    }

    public function getStatusesUrl(): string
    {
        return $this->statusesUrl;
    }

    public function serialize(): array
    {
        return [
            'apiUrl'            => $this->apiUrl->serialize(),
            'htmlUrl'           => $this->htmlUrl->serialize(),
            'commentsUrl'       => $this->commentsUrl,
            'commitsUrl'        => $this->commitsUrl,
            'diffUrl'           => $this->diffUrl,
            'issueUrl'          => $this->issueUrl,
            'patchUrl'          => $this->patchUrl,
            'reviewCommentUrl'  => $this->reviewCommentUrl,
            'reviewCommentsUrl' => $this->reviewCommentsUrl,
            'statusesUrl'       => $this->statusesUrl,
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            PullRequestApiUrl::deserialize($data['apiUrl']),
            PullRequestHtmlUrl::deserialize($data['htmlUrl']),
            $data['commentsUrl'],
            $data['commitsUrl'],
            $data['diffUrl'],
            $data['issueUrl'],
            $data['patchUrl'],
            $data['reviewCommentUrl'],
            $data['reviewCommentsUrl'],
            $data['statusesUrl']
        );
    }
}
