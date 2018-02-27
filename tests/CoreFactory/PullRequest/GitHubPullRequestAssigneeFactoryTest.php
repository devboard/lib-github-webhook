<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\PullRequest;

use DevboardLib\GitHub\PullRequest\PullRequestAssignee;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestAssigneeFactory;
use Generator;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestAssigneeFactory
 * @group  unit
 */
class GitHubPullRequestAssigneeFactoryTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var GitHubPullRequestAssigneeFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = new GitHubPullRequestAssigneeFactory();
    }

    public function testCreate()
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(PullRequestAssignee::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubPullRequestData() as $pullRequest) {
            if (null !== $pullRequest['pull_request']['assignee']) {
                yield $pullRequest['pull_request']['assignee'];
            }
        }
    }
}
