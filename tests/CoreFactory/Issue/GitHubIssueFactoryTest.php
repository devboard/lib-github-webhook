<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\Issue;

use DevboardLib\GitHub\GitHubIssue;
use DevboardLib\GitHubWebhook\CoreFactory\Issue\GitHubIssueAssigneeFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Issue\GitHubIssueAuthorFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Issue\GitHubIssueFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Label\GitHubLabelFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Milestone\GitHubMilestoneCreatorFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Milestone\GitHubMilestoneFactory;
use Generator;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\Issue\GitHubIssueFactory
 * @group  unit
 */
class GitHubIssueFactoryTest extends TestCase
{
    /** @var GitHubIssueFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = self::instance();
    }

    public function testCreate()
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(GitHubIssue::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubIssueData() as $issue) {
            yield $issue['issue'];
        }
    }

    public static function instance(): GitHubIssueFactory
    {
        return new GitHubIssueFactory(
            new GitHubIssueAuthorFactory(),
            new GitHubIssueAssigneeFactory(),
            new GitHubLabelFactory(),
            new GitHubMilestoneFactory(new GitHubMilestoneCreatorFactory())
        );
    }
}
