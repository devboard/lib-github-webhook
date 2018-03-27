<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\PullRequest;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Hook\RepositoryRelatedEvent;

interface PullRequestEvent extends RepositoryRelatedEvent
{
    public function getPullRequest(): PullRequest;
}
