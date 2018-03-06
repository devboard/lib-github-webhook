<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Hook;

use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHubWebhook\Core\Repo;

interface RepositoryRelatedEvent extends GitHubHookEvent
{
    public function getRepo(): Repo;

    public function getRepoId(): RepoId;

    public function getRepoFullName(): RepoFullName;
}
