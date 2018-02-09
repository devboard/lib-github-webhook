<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core;

use DevboardLib\Generix\EmailAddress;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\PusherSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\PusherTest
 */
class Pusher
{
    /** @var string */
    private $name;

    /** @var EmailAddress */
    private $email;

    public function __construct(string $name, EmailAddress $email)
    {
        $this->name  = $name;
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): EmailAddress
    {
        return $this->email;
    }

    public function serialize(): array
    {
        return ['name' => $this->name, 'email' => $this->email->serialize()];
    }

    public static function deserialize(array $data): self
    {
        return new self($data['name'], EmailAddress::deserialize($data['email']));
    }
}
