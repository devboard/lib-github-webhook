<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\PullRequest;

use DevboardLib\Git\Branch\BranchName;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestHead;
use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;

/**
 * @see GitHubPullRequestHeadFactorySpec
 * @see GitHubPullRequestHeadFactoryTest
 */
class GitHubPullRequestHeadFactory
{
    /**
     * @var RepoFactory
     */
    private $repoFactory;

    public function __construct(RepoFactory $repoFactory)
    {
        $this->repoFactory = $repoFactory;
    }

    public function create(array $data): PullRequestHead
    {
        if (null === $data['repo']) {
            $repo = null;
        } else {
            $repo = $this->repoFactory->create($data['repo']);
        }

        return new PullRequestHead(new BranchName($data['ref']), $repo, new CommitSha($data['sha']));
    }
}
