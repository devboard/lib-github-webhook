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

    public function __construct(CommitterName $name, EmailAddress $email, ?UserLogin $username)
    {
        $this->name     = $name;
        $this->email    = $email;
        $this->username = $username;
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

    public function serialize(): array
    {
        if (null !== $this->username) {
            $username = $this->username->serialize();
        } else {
            $username = null;
        }

        return ['name' => $this->name->serialize(), 'email' => $this->email->serialize(), 'username' => $username];
    }

    public static function deserialize(array $data): self
    {
        if (null !== $data['username']) {
            $username = UserLogin::deserialize($data['username']);
        } else {
            $username = null;
        }

        return new self(
            CommitterName::deserialize($data['name']), EmailAddress::deserialize($data['email']), $username
        );
    }
}
