<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\PullRequestReview;

use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewAuthor;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewBody;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewId;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewState;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewSubmittedAt;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReviewSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReviewTest
 */
class PullRequestReview
{
    /** @var PullRequestReviewId */
    private $id;

    /** @var PullRequestReviewBody */
    private $body;

    /** @var PullRequestReviewAuthor */
    private $author;

    /** @var string|null */
    private $authorAssociation;

    /** @var PullRequestReviewState */
    private $state;

    /** @var CommitSha */
    private $commitSha;

    /** @var PullRequestReviewUrls */
    private $urls;

    /** @var PullRequestReviewSubmittedAt|null */
    private $submittedAt;

    public function __construct(
        PullRequestReviewId $id,
        PullRequestReviewBody $body,
        PullRequestReviewAuthor $author,
        ?string $authorAssociation,
        PullRequestReviewState $state,
        CommitSha $commitSha,
        PullRequestReviewUrls $urls,
        ?PullRequestReviewSubmittedAt $submittedAt
    ) {
        $this->id                = $id;
        $this->body              = $body;
        $this->author            = $author;
        $this->authorAssociation = $authorAssociation;
        $this->state             = $state;
        $this->commitSha         = $commitSha;
        $this->urls              = $urls;
        $this->submittedAt       = $submittedAt;
    }

    public function getId(): PullRequestReviewId
    {
        return $this->id;
    }

    public function getBody(): PullRequestReviewBody
    {
        return $this->body;
    }

    public function getAuthor(): PullRequestReviewAuthor
    {
        return $this->author;
    }

    public function getAuthorAssociation(): ?string
    {
        return $this->authorAssociation;
    }

    public function getState(): PullRequestReviewState
    {
        return $this->state;
    }

    public function getCommitSha(): CommitSha
    {
        return $this->commitSha;
    }

    public function getUrls(): PullRequestReviewUrls
    {
        return $this->urls;
    }

    public function getSubmittedAt(): ?PullRequestReviewSubmittedAt
    {
        return $this->submittedAt;
    }

    public function hasAuthorAssociation(): bool
    {
        if (null === $this->authorAssociation) {
            return false;
        }

        return true;
    }

    public function serialize(): array
    {
        if (null === $this->submittedAt) {
            $submittedAt = null;
        } else {
            $submittedAt = $this->submittedAt->serialize();
        }

        return [
            'id'                => $this->id->serialize(),
            'body'              => $this->body->serialize(),
            'author'            => $this->author->serialize(),
            'authorAssociation' => $this->authorAssociation,
            'state'             => $this->state->serialize(),
            'commitSha'         => $this->commitSha->serialize(),
            'urls'              => $this->urls->serialize(),
            'submittedAt'       => $submittedAt,
        ];
    }

    public static function deserialize(array $data): self
    {
        if (null === $data['submittedAt']) {
            $submittedAt = null;
        } else {
            $submittedAt = PullRequestReviewSubmittedAt::deserialize($data['submittedAt']);
        }

        return new self(
            PullRequestReviewId::deserialize($data['id']),
            PullRequestReviewBody::deserialize($data['body']),
            PullRequestReviewAuthor::deserialize($data['author']),
            $data['authorAssociation'],
            PullRequestReviewState::deserialize($data['state']),
            CommitSha::deserialize($data['commitSha']),
            PullRequestReviewUrls::deserialize($data['urls']),
            $submittedAt
        );
    }
}
