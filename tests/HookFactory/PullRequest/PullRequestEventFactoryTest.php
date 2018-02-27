<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\HookFactory\PullRequest;

use DevboardLib\GitHubWebhook\CoreFactory\Label\GitHubLabelFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestAssigneeFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestReviewerFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\PullRequest\PullRequestEvent;
use DevboardLib\GitHubWebhook\HookFactory\PullRequest\PullRequestEventFactory;
use Generator;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestFactoryTest;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\RepoFactoryTest;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\HookFactory\PullRequest\PullRequestEventFactory
 * @group  unit
 */
class PullRequestEventFactoryTest extends TestCase
{
    /** @var PullRequestEventFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = self::instance();
    }

    public function testCreate()
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(PullRequestEvent::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubPullRequestData() as $pullRequest) {
            yield $pullRequest;
        }
    }

    public static function instance(): PullRequestEventFactory
    {
        return new PullRequestEventFactory(
            GitHubPullRequestFactoryTest::instance(),
            RepoFactoryTest::instance(),
            new SenderFactory(),
            new GitHubLabelFactory(),
            new GitHubPullRequestAssigneeFactory(),
            new GitHubPullRequestReviewerFactory()
        );
    }
}
