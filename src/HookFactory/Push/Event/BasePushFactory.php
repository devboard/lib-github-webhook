<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\HookFactory\Push\Event;

interface BasePushFactory
{
    public function isSatisfiedBy(array $data): bool;

    public function create(array $data);
}
