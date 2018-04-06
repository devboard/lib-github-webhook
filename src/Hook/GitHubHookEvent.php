<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook;

use DevboardLib\GitHubWebhook\Core\Sender;

interface GitHubHookEvent
{
    public function getSender(): Sender;
}
