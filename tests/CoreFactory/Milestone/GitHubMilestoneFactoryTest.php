<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\Milestone;

use DevboardLib\GitHub\GitHubMilestone;
use DevboardLib\GitHubWebhook\CoreFactory\Milestone\GitHubMilestoneCreatorFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Milestone\GitHubMilestoneFactory;
use Generator;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\Milestone\GitHubMilestoneFactory
 * @group  unit
 */
class GitHubMilestoneFactoryTest extends TestCase
{
    /** @var GitHubMilestoneFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = self::instance();
    }

    public function testCreate()
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(GitHubMilestone::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubIssueData() as $issue) {
            if (null !== $issue['issue']['milestone']) {
                yield $issue['issue']['milestone'];
            }
        }
    }

    public static function instance(): GitHubMilestoneFactory
    {
        return new GitHubMilestoneFactory(new GitHubMilestoneCreatorFactory());
    }
}
