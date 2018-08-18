<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\HookFactory\IssueComment;

use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\IssueComment\IssueCommentEvent;
use DevboardLib\GitHubWebhook\HookFactory\IssueComment\IssueCommentEventFactory;
use Generator;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\IssueComment\GitHubIssueCommentFactoryTest;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\IssueComment\GitHubIssueFactoryTest;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\RepoFactoryTest;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\HookFactory\IssueComment\IssueCommentEventFactory
 * @group  unit
 */
class IssueCommentEventFactoryTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var IssueCommentEventFactory */
    private $sut;

    public function setUp(): void
    {
        $this->sut = self::instance();
    }

    public function testGetSupportedEventType(): void
    {
        self::assertEquals('issue_comment', $this->sut->getSupportedEventType());
    }

    public function testSerializeAndDeserialize(): void
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(IssueCommentEvent::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubIssueCommentData() as $data) {
            yield $data;
        }
    }

    public static function instance(): IssueCommentEventFactory
    {
        return new IssueCommentEventFactory(
            GitHubIssueCommentFactoryTest::instance(),
            GitHubIssueFactoryTest::instance(),
            RepoFactoryTest::instance(),
            new SenderFactory()
        );
    }
}
