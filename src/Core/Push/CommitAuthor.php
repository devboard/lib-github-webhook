<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\Author\AuthorName;
use DevboardLib\GitHub\User\UserLogin;
use Git\Commit\CommitAuthor as CommitCommitAuthor;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\Push\CommitAuthorSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\Push\CommitAuthorTest
 */
class CommitAuthor implements CommitCommitAuthor
{
    /** @var AuthorName */
    private $name;

    /** @var EmailAddress */
    private $email;

    /** @var UserLogin|null */
    private $username;

    /** @var CommitAuthorDetails|null */
    private $details;

    public function __construct(
        AuthorName $name, EmailAddress $email, ?UserLogin $username, ?CommitAuthorDetails $details
    ) {
        $this->name     = $name;
        $this->email    = $email;
        $this->username = $username;
        $this->details  = $details;
    }

    public function getName(): AuthorName
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

    public function getDetails(): ?CommitAuthorDetails
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
            $details = CommitAuthorDetails::deserialize($data['details']);
        }

        return new self(
            AuthorName::deserialize($data['name']), EmailAddress::deserialize($data['email']), $username, $details
        );
    }
}
