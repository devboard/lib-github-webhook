<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\HookFactory\Push;

use DomainException;

class UnmatchedPushEventException extends DomainException
{
    /** @SuppressWarnings("PHPMD.UnusedFormalParameter") */
    public static function create(array $data): self
    {
        return new self('Unmatched push event');
    }
}
