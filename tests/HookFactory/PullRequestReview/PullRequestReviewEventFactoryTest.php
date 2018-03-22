<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\HookFactory\PullRequestReview;

use DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview\GitHubPullRequestReviewAuthorFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview\GitHubPullRequestReviewFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\PullRequestReview\PullRequestReviewEvent;
use DevboardLib\GitHubWebhook\HookFactory\PullRequestReview\PullRequestReviewEventFactory;
use Generator;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview\GitHubPullRequestFactoryTest;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\RepoFactoryTest;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\HookFactory\PullRequestReview\PullRequestReviewEventFactory
 * @group  unit
 */
class PullRequestReviewEventFactoryTest extends TestCase
{
    /** @var PullRequestReviewEventFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = self::instance();
    }

    public function testCreate()
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(PullRequestReviewEvent::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubPullRequestReviewData() as $pullRequest) {
            yield $pullRequest;
        }
    }

    public static function instance(): PullRequestReviewEventFactory
    {
        return new PullRequestReviewEventFactory(
            new GitHubPullRequestReviewFactory(new GitHubPullRequestReviewAuthorFactory()),
            GitHubPullRequestFactoryTest::instance(),
            RepoFactoryTest::instance(),
            new SenderFactory()
        );
    }
}
