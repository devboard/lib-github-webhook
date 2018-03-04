<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\Push;

use DevboardLib\GitHubWebhook\Hook\RepositoryRelatedEvent;

interface PushEvent extends RepositoryRelatedEvent
{
}
