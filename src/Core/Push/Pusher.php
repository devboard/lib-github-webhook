<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\GitHub\User\UserLogin;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\Push\PusherSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\Push\PusherTest
 */
class Pusher
{
    /** @var UserLogin */
    private $login;

    /** @var EmailAddress|null */
    private $emailAddress;

    public function __construct(UserLogin $login, ?EmailAddress $emailAddress)
    {
        $this->login        = $login;
        $this->emailAddress = $emailAddress;
    }

    public function getLogin(): UserLogin
    {
        return $this->login;
    }

    public function getEmailAddress(): ?EmailAddress
    {
        return $this->emailAddress;
    }

    public function hasEmailAddress(): bool
    {
        if (null === $this->emailAddress) {
            return false;
        }

        return true;
    }

    public function serialize(): array
    {
        if (null === $this->emailAddress) {
            $emailAddress = null;
        } else {
            $emailAddress = $this->emailAddress->serialize();
        }

        return ['login' => $this->login->serialize(), 'emailAddress' => $emailAddress];
    }

    public static function deserialize(array $data): self
    {
        if (null === $data['emailAddress']) {
            $emailAddress = null;
        } else {
            $emailAddress = EmailAddress::deserialize($data['emailAddress']);
        }

        return new self(UserLogin::deserialize($data['login']), $emailAddress);
    }
}
