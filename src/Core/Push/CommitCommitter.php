<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\Committer\CommitterName;
use DevboardLib\GitHub\User\UserLogin;
use Git\Commit\CommitCommitter as CommitCommitCommitter;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\Push\CommitCommitterSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\Push\CommitCommitterTest
 */
class CommitCommitter implements CommitCommitCommitter
{
    /** @var CommitterName */
    private $name;

    /** @var EmailAddress */
    private $email;

    /** @var UserLogin|null */
    private $username;

    /** @var CommitCommitterDetails|null */
    private $details;

    public function __construct(
        CommitterName $name, EmailAddress $email, ?UserLogin $username, ?CommitCommitterDetails $details
    ) {
        $this->name     = $name;
        $this->email    = $email;
        $this->username = $username;
        $this->details  = $details;
    }

    public function getName(): CommitterName
    {
        return $this->name;
    }

    public function getEmail(): EmailAddress
    {
        return $this->email;
    }

    public function getUsername(): ?UserLogin
    {
        return $this->username;
    }

    public function getDetails(): ?CommitCommitterDetails
    {
        return $this->details;
    }

    public function hasUsername(): bool
    {
        if (null === $this->username) {
            return false;
        }

        return true;
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
        if (null === $this->username) {
            $username = null;
        } else {
            $username = $this->username->serialize();
        }

        if (null === $this->details) {
            $details = null;
        } else {
            $details = $this->details->serialize();
        }

        return [
            'name'     => $this->name->serialize(),
            'email'    => $this->email->serialize(),
            'username' => $username,
            'details'  => $details,
        ];
    }

    public static function deserialize(array $data): self
    {
        if (null === $data['username']) {
            $username = null;
        } else {
            $username = UserLogin::deserialize($data['username']);
        }

        if (null === $data['details']) {
            $details = null;
        } else {
            $details = CommitCommitterDetails::deserialize($data['details']);
        }

        return new self(
            CommitterName::deserialize($data['name']),
            EmailAddress::deserialize($data['email']),
            $username,
            $details
        );
    }
}
