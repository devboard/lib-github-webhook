<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestAssigneeFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestAuthorFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestBaseFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestHeadFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestMergedByFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestRequestedReviewerFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview\GitHubPullRequestFactory;
use Generator;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\Milestone\GitHubMilestoneFactoryTest;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\RepoFactoryTest;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview\GitHubPullRequestFactory
 * @group  unit
 */
class GitHubPullRequestFactoryTest extends TestCase
{
    /** @var GitHubPullRequestFactory */
    private $sut;

    public function setUp(): void
    {
        $this->sut = self::instance();
    }

    public function testCreate(): void
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(PullRequest::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubPullRequestReviewData() as $pullRequest) {
            yield $pullRequest['pull_request'];
        }
    }

    public static function instance(): GitHubPullRequestFactory
    {
        return new GitHubPullRequestFactory(
            new GitHubPullRequestAuthorFactory(),
            new GitHubPullRequestAssigneeFactory(),
            GitHubMilestoneFactoryTest::instance(),
            new GitHubPullRequestMergedByFactory(),
            new GitHubPullRequestRequestedReviewerFactory(),
            new GitHubPullRequestBaseFactory(RepoFactoryTest::instance()),
            new GitHubPullRequestHeadFactory(RepoFactoryTest::instance())
        );
    }
}
