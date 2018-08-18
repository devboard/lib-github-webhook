<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\IssueComment;

use DevboardLib\GitHub\Issue\IssueId;
use DevboardLib\GitHub\IssueComment\IssueCommentBody;
use DevboardLib\GitHub\IssueComment\IssueCommentCreatedAt;
use DevboardLib\GitHub\IssueComment\IssueCommentId;
use DevboardLib\GitHub\IssueComment\IssueCommentUpdatedAt;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\IssueComment\IssueCommentDetailsSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\IssueComment\IssueCommentDetailsTest
 */
class IssueCommentDetails
{
    /** @var IssueCommentId */
    private $id;

    /** @var IssueId */
    private $issueId;

    /** @var IssueCommentBody */
    private $body;

    /** @var IssueCommentAuthor */
    private $author;

    /** @var IssueCommentCreatedAt */
    private $createdAt;

    /** @var IssueCommentUpdatedAt */
    private $updatedAt;

    public function __construct(
        IssueCommentId $id,
        IssueId $issueId,
        IssueCommentBody $body,
        IssueCommentAuthor $author,
        IssueCommentCreatedAt $createdAt,
        IssueCommentUpdatedAt $updatedAt
    ) {
        $this->id        = $id;
        $this->issueId   = $issueId;
        $this->body      = $body;
        $this->author    = $author;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): IssueCommentId
    {
        return $this->id;
    }

    public function getIssueId(): IssueId
    {
        return $this->issueId;
    }

    public function getBody(): IssueCommentBody
    {
        return $this->body;
    }

    public function getAuthor(): IssueCommentAuthor
    {
        return $this->author;
    }

    public function getCreatedAt(): IssueCommentCreatedAt
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): IssueCommentUpdatedAt
    {
        return $this->updatedAt;
    }

    public function serialize(): array
    {
        return [
            'id'        => $this->id->serialize(),
            'issueId'   => $this->issueId->serialize(),
            'body'      => $this->body->serialize(),
            'author'    => $this->author->serialize(),
            'createdAt' => $this->createdAt->serialize(),
            'updatedAt' => $this->updatedAt->serialize(),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            IssueCommentId::deserialize($data['id']),
            IssueId::deserialize($data['issueId']),
            IssueCommentBody::deserialize($data['body']),
            IssueCommentAuthor::deserialize($data['author']),
            IssueCommentCreatedAt::deserialize($data['createdAt']),
            IssueCommentUpdatedAt::deserialize($data['updatedAt'])
        );
    }
}
