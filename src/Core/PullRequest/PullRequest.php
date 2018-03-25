<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\PullRequest;

use DateTime;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHub\GitHubMilestone;
use DevboardLib\GitHub\PullRequest\PullRequestAssigneeCollection;
use DevboardLib\GitHub\PullRequest\PullRequestAuthor;
use DevboardLib\GitHub\PullRequest\PullRequestBody;
use DevboardLib\GitHub\PullRequest\PullRequestClosedAt;
use DevboardLib\GitHub\PullRequest\PullRequestCreatedAt;
use DevboardLib\GitHub\PullRequest\PullRequestId;
use DevboardLib\GitHub\PullRequest\PullRequestNumber;
use DevboardLib\GitHub\PullRequest\PullRequestState;
use DevboardLib\GitHub\PullRequest\PullRequestTitle;
use DevboardLib\GitHub\PullRequest\PullRequestUpdatedAt;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.TooManyFields)
 *
 * @see \spec\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestTest
 */
class PullRequest
{
    /** @var PullRequestId */
    private $id;

    /** @var PullRequestNumber */
    private $number;

    /** @var PullRequestBase */
    private $base;

    /** @var PullRequestHead */
    private $head;

    /** @var PullRequestTitle */
    private $title;

    /** @var PullRequestBody */
    private $body;

    /** @var PullRequestState */
    private $state;

    /** @var PullRequestAuthor */
    private $author;

    /** @var PullRequestAssigneeCollection */
    private $assignees;

    /** @var PullRequestRequestedReviewerCollection */
    private $requestedReviewers;

    /** @var PullRequestRequestedTeamCollection */
    private $requestedTeams;

    /** @var bool */
    private $locked;

    /** @var bool|null */
    private $rebaseable;

    /** @var bool */
    private $maintainerCanModify;

    /** @var CommitSha|null */
    private $mergeCommitSha;

    /** @var bool|null */
    private $mergeable;

    /** @var string */
    private $mergeableState;

    /** @var bool */
    private $merged;

    /** @var DateTime|null */
    private $mergedAt;

    /** @var PullRequestMergedBy|null */
    private $mergedBy;

    /** @var GitHubMilestone|null */
    private $milestone;

    /** @var PullRequestClosedAt|null */
    private $closedAt;

    /** @var PullRequestStats */
    private $stats;

    /** @var PullRequestUrls */
    private $urls;

    /** @var PullRequestCreatedAt */
    private $createdAt;

    /** @var PullRequestUpdatedAt */
    private $updatedAt;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        PullRequestId $id,
        PullRequestNumber $number,
        PullRequestBase $base,
        PullRequestHead $head,
        PullRequestTitle $title,
        PullRequestBody $body,
        PullRequestState $state,
        PullRequestAuthor $author,
        PullRequestAssigneeCollection $assignees,
        PullRequestRequestedReviewerCollection $requestedReviewers,
        PullRequestRequestedTeamCollection $requestedTeams,
        bool $locked,
        ?bool $rebaseable,
        bool $maintainerCanModify,
        ?CommitSha $mergeCommitSha,
        ?bool $mergeable,
        string $mergeableState,
        bool $merged,
        ?DateTime $mergedAt,
        ?PullRequestMergedBy $mergedBy,
        ?GitHubMilestone $milestone,
        ?PullRequestClosedAt $closedAt,
        PullRequestStats $stats,
        PullRequestUrls $urls,
        PullRequestCreatedAt $createdAt,
        PullRequestUpdatedAt $updatedAt
    ) {
        $this->id                  = $id;
        $this->number              = $number;
        $this->base                = $base;
        $this->head                = $head;
        $this->title               = $title;
        $this->body                = $body;
        $this->state               = $state;
        $this->author              = $author;
        $this->assignees           = $assignees;
        $this->requestedReviewers  = $requestedReviewers;
        $this->requestedTeams      = $requestedTeams;
        $this->locked              = $locked;
        $this->rebaseable          = $rebaseable;
        $this->maintainerCanModify = $maintainerCanModify;
        $this->mergeCommitSha      = $mergeCommitSha;
        $this->mergeable           = $mergeable;
        $this->mergeableState      = $mergeableState;
        $this->merged              = $merged;
        $this->mergedAt            = $mergedAt;
        $this->mergedBy            = $mergedBy;
        $this->milestone           = $milestone;
        $this->closedAt            = $closedAt;
        $this->stats               = $stats;
        $this->urls                = $urls;
        $this->createdAt           = $createdAt;
        $this->updatedAt           = $updatedAt;
    }

    public function getId(): PullRequestId
    {
        return $this->id;
    }

    public function getNumber(): PullRequestNumber
    {
        return $this->number;
    }

    public function getBase(): PullRequestBase
    {
        return $this->base;
    }

    public function getHead(): PullRequestHead
    {
        return $this->head;
    }

    public function getTitle(): PullRequestTitle
    {
        return $this->title;
    }

    public function getBody(): PullRequestBody
    {
        return $this->body;
    }

    public function getState(): PullRequestState
    {
        return $this->state;
    }

    public function getAuthor(): PullRequestAuthor
    {
        return $this->author;
    }

    public function getAssignees(): PullRequestAssigneeCollection
    {
        return $this->assignees;
    }

    public function getRequestedReviewers(): PullRequestRequestedReviewerCollection
    {
        return $this->requestedReviewers;
    }

    public function getRequestedTeams(): PullRequestRequestedTeamCollection
    {
        return $this->requestedTeams;
    }

    public function isLocked(): bool
    {
        return $this->locked;
    }

    public function isRebaseable(): ?bool
    {
        return $this->rebaseable;
    }

    public function isMaintainerCanModify(): bool
    {
        return $this->maintainerCanModify;
    }

    public function getMergeCommitSha(): ?CommitSha
    {
        return $this->mergeCommitSha;
    }

    public function isMergeable(): ?bool
    {
        return $this->mergeable;
    }

    public function getMergeableState(): string
    {
        return $this->mergeableState;
    }

    public function isMerged(): bool
    {
        return $this->merged;
    }

    public function getMergedAt(): ?DateTime
    {
        return $this->mergedAt;
    }

    public function getMergedBy(): ?PullRequestMergedBy
    {
        return $this->mergedBy;
    }

    public function getMilestone(): ?GitHubMilestone
    {
        return $this->milestone;
    }

    public function getClosedAt(): ?PullRequestClosedAt
    {
        return $this->closedAt;
    }

    public function getStats(): PullRequestStats
    {
        return $this->stats;
    }

    public function getUrls(): PullRequestUrls
    {
        return $this->urls;
    }

    public function getCreatedAt(): PullRequestCreatedAt
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): PullRequestUpdatedAt
    {
        return $this->updatedAt;
    }

    public function hasRebaseable(): bool
    {
        if (null === $this->rebaseable) {
            return false;
        }

        return true;
    }

    public function hasMergeCommitSha(): bool
    {
        if (null === $this->mergeCommitSha) {
            return false;
        }

        return true;
    }

    public function hasMergeable(): bool
    {
        if (null === $this->mergeable) {
            return false;
        }

        return true;
    }

    public function hasMergedAt(): bool
    {
        if (null === $this->mergedAt) {
            return false;
        }

        return true;
    }

    public function hasMergedBy(): bool
    {
        if (null === $this->mergedBy) {
            return false;
        }

        return true;
    }

    public function hasMilestone(): bool
    {
        if (null === $this->milestone) {
            return false;
        }

        return true;
    }

    public function hasClosedAt(): bool
    {
        if (null === $this->closedAt) {
            return false;
        }

        return true;
    }

    public function serialize(): array
    {
        if (null === $this->mergeCommitSha) {
            $mergeCommitSha = null;
        } else {
            $mergeCommitSha = $this->mergeCommitSha->serialize();
        }

        if (null === $this->mergedAt) {
            $mergedAt = null;
        } else {
            $mergedAt = $this->mergedAt->format('c');
        }

        if (null === $this->mergedBy) {
            $mergedBy = null;
        } else {
            $mergedBy = $this->mergedBy->serialize();
        }

        if (null === $this->milestone) {
            $milestone = null;
        } else {
            $milestone = $this->milestone->serialize();
        }

        if (null === $this->closedAt) {
            $closedAt = null;
        } else {
            $closedAt = $this->closedAt->serialize();
        }

        return [
            'id'                  => $this->id->serialize(),
            'number'              => $this->number->serialize(),
            'base'                => $this->base->serialize(),
            'head'                => $this->head->serialize(),
            'title'               => $this->title->serialize(),
            'body'                => $this->body->serialize(),
            'state'               => $this->state->serialize(),
            'author'              => $this->author->serialize(),
            'assignees'           => $this->assignees->serialize(),
            'requestedReviewers'  => $this->requestedReviewers->serialize(),
            'requestedTeams'      => $this->requestedTeams->serialize(),
            'locked'              => $this->locked,
            'rebaseable'          => $this->rebaseable,
            'maintainerCanModify' => $this->maintainerCanModify,
            'mergeCommitSha'      => $mergeCommitSha,
            'mergeable'           => $this->mergeable,
            'mergeableState'      => $this->mergeableState,
            'merged'              => $this->merged,
            'mergedAt'            => $mergedAt,
            'mergedBy'            => $mergedBy,
            'milestone'           => $milestone,
            'closedAt'            => $closedAt,
            'stats'               => $this->stats->serialize(),
            'urls'                => $this->urls->serialize(),
            'createdAt'           => $this->createdAt->serialize(),
            'updatedAt'           => $this->updatedAt->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        if (null === $data['mergeCommitSha']) {
            $mergeCommitSha = null;
        } else {
            $mergeCommitSha = CommitSha::deserialize($data['mergeCommitSha']);
        }

        if (null === $data['mergedAt']) {
            $mergedAt = null;
        } else {
            $mergedAt = new DateTime($data['mergedAt']);
        }

        if (null === $data['mergedBy']) {
            $mergedBy = null;
        } else {
            $mergedBy = PullRequestMergedBy::deserialize($data['mergedBy']);
        }

        if (null === $data['milestone']) {
            $milestone = null;
        } else {
            $milestone = GitHubMilestone::deserialize($data['milestone']);
        }

        if (null === $data['closedAt']) {
            $closedAt = null;
        } else {
            $closedAt = PullRequestClosedAt::deserialize($data['closedAt']);
        }

        return new self(
            PullRequestId::deserialize($data['id']),
            PullRequestNumber::deserialize($data['number']),
            PullRequestBase::deserialize($data['base']),
            PullRequestHead::deserialize($data['head']),
            PullRequestTitle::deserialize($data['title']),
            PullRequestBody::deserialize($data['body']),
            PullRequestState::deserialize($data['state']),
            PullRequestAuthor::deserialize($data['author']),
            PullRequestAssigneeCollection::deserialize($data['assignees']),
            PullRequestRequestedReviewerCollection::deserialize($data['requestedReviewers']),
            PullRequestRequestedTeamCollection::deserialize($data['requestedTeams']),
            $data['locked'],
            $data['rebaseable'],
            $data['maintainerCanModify'],
            $mergeCommitSha,
            $data['mergeable'],
            $data['mergeableState'],
            $data['merged'],
            $mergedAt,
            $mergedBy,
            $milestone,
            $closedAt,
            PullRequestStats::deserialize($data['stats']),
            PullRequestUrls::deserialize($data['urls']),
            PullRequestCreatedAt::deserialize($data['createdAt']),
            PullRequestUpdatedAt::deserialize($data['updatedAt'])
        );
    }
}
