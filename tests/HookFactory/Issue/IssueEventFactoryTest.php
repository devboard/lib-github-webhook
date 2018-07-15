<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\HookFactory\Issue;

use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\Issue\IssueEvent;
use DevboardLib\GitHubWebhook\HookFactory\Issue\IssueEventFactory;
use Generator;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\Issue\GitHubIssueFactoryTest;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\RepoFactoryTest;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\HookFactory\Issue\IssueEventFactory
 * @group  unit
 */
class IssueEventFactoryTest extends TestCase
{
    /** @var IssueEventFactory */
    private $sut;

    public function setUp(): void
    {
        $this->sut = self::instance();
    }

    public function testCreate(): void
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(IssueEvent::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubIssueData() as $issue) {
            yield $issue;
        }
    }

    public static function instance(): IssueEventFactory
    {
        return new IssueEventFactory(
            GitHubIssueFactoryTest::instance(), RepoFactoryTest::instance(), new SenderFactory()
        );
    }
}
