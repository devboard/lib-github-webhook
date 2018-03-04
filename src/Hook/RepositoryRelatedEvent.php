<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook;

use DevboardLib\GitHubWebhook\Core\Repo;

interface RepositoryRelatedEvent extends GitHubHookEvent
{
    public function getRepo(): Repo;
}
