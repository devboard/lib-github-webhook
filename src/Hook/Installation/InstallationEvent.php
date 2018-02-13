<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\Installation;

use DevboardLib\GitHub\GitHubInstallation;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\GitHubHookEvent;

interface InstallationEvent extends GitHubHookEvent
{
    public function getInstallation(): GitHubInstallation;

    public function getSender(): Sender;
}
