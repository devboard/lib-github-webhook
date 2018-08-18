<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\IssueComment;

use DevboardLib\GitHubWebhook\Core\IssueComment\IssueAuthor;
use DevboardLib\GitHubWebhook\CoreFactory\IssueComment\GitHubIssueAuthorFactory;
use Generator;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\IssueComment\GitHubIssueAuthorFactory
 * @group  unit
 */
class GitHubIssueAuthorFactoryTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var GitHubIssueAuthorFactory */
    private $sut;

    public function setUp(): void
    {
        $this->sut = new GitHubIssueAuthorFactory();
    }

    public function testCreate(): void
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(IssueAuthor::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubIssueData() as $issue) {
            yield $issue['issue']['user'];
        }
    }
}
