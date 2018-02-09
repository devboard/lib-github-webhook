<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\GitHub\User\UserLogin;

/**
 * @see PusherSpec
 * @see PusherTest
 */
class Pusher
{
    /** @var UserLogin */
    private $login;

    /** @var EmailAddress */
    private $emailAddress;

    public function __construct(UserLogin $login, EmailAddress $emailAddress)
    {
        $this->login        = $login;
        $this->emailAddress = $emailAddress;
    }

    public static function create(string $login, string $emailAddress): self
    {
        return new self(new UserLogin($login), new EmailAddress($emailAddress));
    }

    public function getLogin(): UserLogin
    {
        return $this->login;
    }

    public function getEmailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    public function serialize(): array
    {
        return ['login' => (string) $this->login, 'emailAddress' => (string) $this->emailAddress];
    }

    public static function deserialize(array $data): self
    {
        return new self(new UserLogin($data['login']), new EmailAddress($data['emailAddress']));
    }
}
