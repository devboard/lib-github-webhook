<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\Installation;

use DevboardLib\GitHubWebhook\Core\Installation\InstallationDetails;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\GitHubHookEvent;

interface InstallationEvent extends GitHubHookEvent
{
    public function getInstallation(): InstallationDetails;

    public function getSender(): Sender;
}
