<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHub\GitHubLabelCollection;
use DevboardLib\GitHub\GitHubMilestone;
use DevboardLib\GitHub\PullRequest\PullRequestApiUrl;
use DevboardLib\GitHub\PullRequest\PullRequestAssignee;
use DevboardLib\GitHub\PullRequest\PullRequestAssigneeCollection;
use DevboardLib\GitHub\PullRequest\PullRequestAuthor;
use DevboardLib\GitHub\PullRequest\PullRequestBody;
use DevboardLib\GitHub\PullRequest\PullRequestClosedAt;
use DevboardLib\GitHub\PullRequest\PullRequestCreatedAt;
use DevboardLib\GitHub\PullRequest\PullRequestHtmlUrl;
use DevboardLib\GitHub\PullRequest\PullRequestId;
use DevboardLib\GitHub\PullRequest\PullRequestNumber;
use DevboardLib\GitHub\PullRequest\PullRequestState;
use DevboardLib\GitHub\PullRequest\PullRequestTitle;
use DevboardLib\GitHub\PullRequest\PullRequestUpdatedAt;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
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

    /** @var PullRequestTitle */
    private $title;

    /** @var PullRequestBody */
    private $body;

    /** @var PullRequestState */
    private $state;

    /** @var PullRequestAuthor */
    private $author;

    /** @var PullRequestApiUrl */
    private $apiUrl;

    /** @var PullRequestHtmlUrl */
    private $htmlUrl;

    /** @var PullRequestAssignee|null */
    private $assignee;

    /** @var PullRequestAssigneeCollection */
    private $assignees;

    /** @var GitHubLabelCollection */
    private $labels;

    /** @var GitHubMilestone|null */
    private $milestone;

    /** @var PullRequestClosedAt|null */
    private $closedAt;

    /** @var PullRequestCreatedAt */
    private $createdAt;

    /** @var PullRequestUpdatedAt */
    private $updatedAt;

    public function __construct(
        PullRequestId $id,
        PullRequestNumber $number,
        PullRequestTitle $title,
        PullRequestBody $body,
        PullRequestState $state,
        PullRequestAuthor $author,
        PullRequestApiUrl $apiUrl,
        PullRequestHtmlUrl $htmlUrl,
        ?PullRequestAssignee $assignee,
        PullRequestAssigneeCollection $assignees,
        GitHubLabelCollection $labels,
        ?GitHubMilestone $milestone,
        ?PullRequestClosedAt $closedAt,
        PullRequestCreatedAt $createdAt,
        PullRequestUpdatedAt $updatedAt
    ) {
        $this->id        = $id;
        $this->number    = $number;
        $this->title     = $title;
        $this->body      = $body;
        $this->state     = $state;
        $this->author    = $author;
        $this->apiUrl    = $apiUrl;
        $this->htmlUrl   = $htmlUrl;
        $this->assignee  = $assignee;
        $this->assignees = $assignees;
        $this->labels    = $labels;
        $this->milestone = $milestone;
        $this->closedAt  = $closedAt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): PullRequestId
    {
        return $this->id;
    }

    public function getNumber(): PullRequestNumber
    {
        return $this->number;
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

    public function getApiUrl(): PullRequestApiUrl
    {
        return $this->apiUrl;
    }

    public function getHtmlUrl(): PullRequestHtmlUrl
    {
        return $this->htmlUrl;
    }

    public function getAssignee(): ?PullRequestAssignee
    {
        return $this->assignee;
    }

    public function getAssignees(): PullRequestAssigneeCollection
    {
        return $this->assignees;
    }

    public function getLabels(): GitHubLabelCollection
    {
        return $this->labels;
    }

    public function getMilestone(): ?GitHubMilestone
    {
        return $this->milestone;
    }

    public function getClosedAt(): ?PullRequestClosedAt
    {
        return $this->closedAt;
    }

    public function getCreatedAt(): PullRequestCreatedAt
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): PullRequestUpdatedAt
    {
        return $this->updatedAt;
    }

    public function hasAssignee(): bool
    {
        if (null === $this->assignee) {
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
        if (null === $this->assignee) {
            $assignee = null;
        } else {
            $assignee = $this->assignee->serialize();
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
            'id'        => $this->id->serialize(),
            'number'    => $this->number->serialize(),
            'title'     => $this->title->serialize(),
            'body'      => $this->body->serialize(),
            'state'     => $this->state->serialize(),
            'author'    => $this->author->serialize(),
            'apiUrl'    => $this->apiUrl->serialize(),
            'htmlUrl'   => $this->htmlUrl->serialize(),
            'assignee'  => $assignee,
            'assignees' => $this->assignees->serialize(),
            'labels'    => $this->labels->serialize(),
            'milestone' => $milestone,
            'closedAt'  => $closedAt,
            'createdAt' => $this->createdAt->serialize(),
            'updatedAt' => $this->updatedAt->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        if (null === $data['assignee']) {
            $assignee = null;
        } else {
            $assignee = PullRequestAssignee::deserialize($data['assignee']);
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
            PullRequestTitle::deserialize($data['title']),
            PullRequestBody::deserialize($data['body']),
            PullRequestState::deserialize($data['state']),
            PullRequestAuthor::deserialize($data['author']),
            PullRequestApiUrl::deserialize($data['apiUrl']),
            PullRequestHtmlUrl::deserialize($data['htmlUrl']),
            $assignee,
            PullRequestAssigneeCollection::deserialize($data['assignees']),
            GitHubLabelCollection::deserialize($data['labels']),
            $milestone,
            $closedAt,
            PullRequestCreatedAt::deserialize($data['createdAt']),
            PullRequestUpdatedAt::deserialize($data['updatedAt'])
        );
    }
}
