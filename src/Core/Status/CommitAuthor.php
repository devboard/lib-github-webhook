<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Status;

use DateTime;
use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\Author\AuthorName;
use Git\Commit\CommitAuthor as CommitCommitAuthor;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\Status\CommitAuthorSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\Status\CommitAuthorTest
 */
class CommitAuthor implements CommitCommitAuthor
{
    /** @var AuthorName */
    private $name;

    /** @var EmailAddress */
    private $email;

    /** @var DateTime */
    private $createdAt;

    /** @var CommitAuthorDetails|null */
    private $details;

    public function __construct(
        AuthorName $name, EmailAddress $email, DateTime $createdAt, ?CommitAuthorDetails $details
    ) {
        $this->name      = $name;
        $this->email     = $email;
        $this->createdAt = $createdAt;
        $this->details   = $details;
    }

    public function getName(): AuthorName
    {
        return $this->name;
    }

    public function getEmail(): EmailAddress
    {
        return $this->email;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getDetails(): ?CommitAuthorDetails
    {
        return $this->details;
    }

    public function hasDetails(): bool
    {
        if (null === $this->details) {
            return false;
        }

        return true;
    }

    public function serialize(): array
    {
        if (null === $this->details) {
            $details = null;
        } else {
            $details = $this->details->serialize();
        }

        return [
            'name'      => $this->name->serialize(),
            'email'     => $this->email->serialize(),
            'createdAt' => $this->createdAt->format('c'),
            'details'   => $details,
        ];
    }

    public static function deserialize(array $data): self
    {
        if (null === $data['details']) {
            $details = null;
        } else {
            $details = CommitAuthorDetails::deserialize($data['details']);
        }

        return new self(
            AuthorName::deserialize($data['name']),
            EmailAddress::deserialize($data['email']),
            new DateTime($data['createdAt']),
            $details
        );
    }
}
