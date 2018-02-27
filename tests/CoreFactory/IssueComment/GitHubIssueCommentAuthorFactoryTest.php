<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\IssueComment;

use DevboardLib\GitHub\IssueComment\IssueCommentAuthor;
use DevboardLib\GitHubWebhook\CoreFactory\IssueComment\GitHubIssueCommentAuthorFactory;
use Generator;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\IssueComment\GitHubIssueCommentAuthorFactory
 * @group  unit
 */
class GitHubIssueCommentAuthorFactoryTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var GitHubIssueCommentAuthorFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = new GitHubIssueCommentAuthorFactory();
    }

    public function testCreate()
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(IssueCommentAuthor::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubIssueCommentData() as $issue) {
            yield $issue['comment']['user'];
        }
    }
}
