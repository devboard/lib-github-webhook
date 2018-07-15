<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\IssueComment;

use DevboardLib\GitHub\GitHubIssueComment;
use DevboardLib\GitHub\Issue\IssueId;
use DevboardLib\GitHubWebhook\CoreFactory\IssueComment\GitHubIssueCommentAuthorFactory;
use DevboardLib\GitHubWebhook\CoreFactory\IssueComment\GitHubIssueCommentFactory;
use Generator;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\IssueComment\GitHubIssueCommentFactory
 * @group  unit
 */
class GitHubIssueCommentFactoryTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var GitHubIssueCommentFactory */
    private $sut;

    public function setUp(): void
    {
        $this->sut = self::instance();
    }

    public function testCreate(): void
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(
                GitHubIssueComment::class, $this->sut->create($data['comment'], new IssueId($data['issue']['id']))
            );
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubIssueCommentData() as $issueComment) {
            yield $issueComment;
        }
    }

    public static function instance(): GitHubIssueCommentFactory
    {
        return new GitHubIssueCommentFactory(new GitHubIssueCommentAuthorFactory());
    }
}
