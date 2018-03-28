<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook\PullRequestReview;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReview;
use DevboardLib\GitHubWebhook\Hook\RepositoryRelatedEvent;

interface PullRequestReviewEvent extends RepositoryRelatedEvent
{
    public function getReview(): PullRequestReview;

    public function getPullRequest(): PullRequest;
}
