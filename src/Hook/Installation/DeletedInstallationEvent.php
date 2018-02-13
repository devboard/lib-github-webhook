<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\Installation;

use DevboardLib\GitHub\GitHubInstallation;
use DevboardLib\GitHubWebhook\Core\Sender;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Hook\Installation\DeletedInstallationEventSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Hook\Installation\DeletedInstallationEventTest
 */
class DeletedInstallationEvent implements InstallationEvent
{
    /** @var GitHubInstallation */
    private $installation;

    /** @var Sender */
    private $sender;

    public function __construct(GitHubInstallation $installation, Sender $sender)
    {
        $this->installation = $installation;
        $this->sender       = $sender;
    }

    public function getInstallation(): GitHubInstallation
    {
        return $this->installation;
    }

    public function getSender(): Sender
    {
        return $this->sender;
    }

    public function serialize(): array
    {
        return ['installation' => $this->installation->serialize(), 'sender' => $this->sender->serialize()];
    }

    public static function deserialize(array $data): self
    {
        return new self(GitHubInstallation::deserialize($data['installation']), Sender::deserialize($data['sender']));
    }
}
