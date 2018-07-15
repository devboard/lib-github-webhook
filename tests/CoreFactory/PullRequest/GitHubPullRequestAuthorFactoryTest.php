<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\PullRequest;

use DevboardLib\GitHub\PullRequest\PullRequestAuthor;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestAuthorFactory;
use Generator;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestAuthorFactory
 * @group  unit
 */
class GitHubPullRequestAuthorFactoryTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var GitHubPullRequestAuthorFactory */
    private $sut;

    public function setUp(): void
    {
        $this->sut = new GitHubPullRequestAuthorFactory();
    }

    public function testCreate(): void
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(PullRequestAuthor::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubPullRequestData() as $pullRequest) {
            yield $pullRequest['pull_request']['user'];
        }
    }
}
