<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\PullRequest;

use DevboardLib\Git\Branch\BranchName;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestBase;
use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;

/**
 * @see GitHubPullRequestBaseFactorySpec
 * @see GitHubPullRequestBaseFactoryTest
 */
class GitHubPullRequestBaseFactory
{
    /**
     * @var RepoFactory
     */
    private $repoFactory;

    public function __construct(RepoFactory $repoFactory)
    {
        $this->repoFactory = $repoFactory;
    }

    public function create(array $data): PullRequestBase
    {
        return new PullRequestBase(
            new BranchName($data['ref']), $this->repoFactory->create($data['repo']), new CommitSha($data['sha'])
        );
    }
}
