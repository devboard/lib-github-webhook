<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\HookFactory;

interface GitHubHookEventFactory
{
    public function getSupportedEventType(): string;
}
