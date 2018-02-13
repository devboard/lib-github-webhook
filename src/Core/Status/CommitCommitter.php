<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Status;

use DateTime;
use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\Committer\CommitterName;
use Git\Commit\CommitCommitter as CommitCommitCommitter;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\Status\CommitCommitterSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\Status\CommitCommitterTest
 */
class CommitCommitter implements CommitCommitCommitter
{
    /** @var CommitterName */
    private $name;

    /** @var EmailAddress */
    private $email;

    /** @var DateTime */
    private $committedAt;

    /** @var CommitCommitterDetails|null */
    private $details;

    public function __construct(
        CommitterName $name, EmailAddress $email, DateTime $committedAt, ?CommitCommitterDetails $details
    ) {
        $this->name        = $name;
        $this->email       = $email;
        $this->committedAt = $committedAt;
        $this->details     = $details;
    }

    public function getName(): CommitterName
    {
        return $this->name;
    }

    public function getEmail(): EmailAddress
    {
        return $this->email;
    }

    public function getCommittedAt(): DateTime
    {
        return $this->committedAt;
    }

    public function getDetails(): ?CommitCommitterDetails
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
            'name'        => $this->name->serialize(),
            'email'       => $this->email->serialize(),
            'committedAt' => $this->committedAt->format('c'),
            'details'     => $details,
        ];
    }

    public static function deserialize(array $data): self
    {
        if (null === $data['details']) {
            $details = null;
        } else {
            $details = CommitCommitterDetails::deserialize($data['details']);
        }

        return new self(
            CommitterName::deserialize($data['name']),
            EmailAddress::deserialize($data['email']),
            new DateTime($data['committedAt']),
            $details
        );
    }
}
