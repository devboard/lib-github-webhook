<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\Issue;

use DevboardLib\GitHub\Issue\IssueAssignee;
use DevboardLib\GitHubWebhook\CoreFactory\Issue\GitHubIssueAssigneeFactory;
use Generator;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\Issue\GitHubIssueAssigneeFactory
 * @group  unit
 */
class GitHubIssueAssigneeFactoryTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var GitHubIssueAssigneeFactory */
    private $sut;

    public function setUp(): void
    {
        $this->sut = new GitHubIssueAssigneeFactory();
    }

    public function testCreate(): void
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(IssueAssignee::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubIssueData() as $issue) {
            if (null !== $issue['issue']['assignee']) {
                yield $issue['issue']['assignee'];
            }
        }
    }
}
