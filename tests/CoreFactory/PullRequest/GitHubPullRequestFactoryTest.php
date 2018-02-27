<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\PullRequest;

use DevboardLib\GitHub\GitHubPullRequest;
use DevboardLib\GitHubWebhook\CoreFactory\Label\GitHubLabelFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Milestone\GitHubMilestoneCreatorFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Milestone\GitHubMilestoneFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestAssigneeFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestAuthorFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestFactory;
use Generator;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestFactory
 * @group  unit
 */
class GitHubPullRequestFactoryTest extends TestCase
{
    /** @var GitHubPullRequestFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = self::instance();
    }

    public function testCreate()
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(GitHubPullRequest::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubPullRequestData() as $pullRequest) {
            yield $pullRequest['pull_request'];
        }
    }

    public static function instance(): GitHubPullRequestFactory
    {
        return new GitHubPullRequestFactory(
            new GitHubPullRequestAuthorFactory(),
            new GitHubPullRequestAssigneeFactory(),
            new GitHubLabelFactory(),
            new GitHubMilestoneFactory(new GitHubMilestoneCreatorFactory())
        );
    }
}
