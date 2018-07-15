<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview;

use DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReview;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview\GitHubPullRequestReviewAuthorFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview\GitHubPullRequestReviewFactory;
use Generator;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview\GitHubPullRequestReviewFactory
 * @group  unit
 */
class GitHubPullRequestReviewFactoryTest extends TestCase
{
    /** @var GitHubPullRequestReviewFactory */
    private $sut;

    public function setUp(): void
    {
        $this->sut = self::instance();
    }

    public function testCreate(): void
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(PullRequestReview::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubPullRequestReviewData() as $pullRequest) {
            yield $pullRequest['review'];
        }
    }

    public static function instance(): GitHubPullRequestReviewFactory
    {
        return new GitHubPullRequestReviewFactory(new GitHubPullRequestReviewAuthorFactory());
    }
}
