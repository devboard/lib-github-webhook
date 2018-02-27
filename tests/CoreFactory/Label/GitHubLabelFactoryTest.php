<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\Label;

use DevboardLib\GitHub\GitHubLabel;
use DevboardLib\GitHubWebhook\CoreFactory\Label\GitHubLabelFactory;
use Generator;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\Label\GitHubLabelFactory
 * @group  unit
 */
class GitHubLabelFactoryTest extends TestCase
{
    /** @var GitHubLabelFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = new GitHubLabelFactory();
    }

    public function testCreate()
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(GitHubLabel::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubIssueData() as $issue) {
            foreach ($issue['issue']['labels'] as $label) {
                yield $label;
            }
        }
        foreach ((new StagingDataProvider())->getGitHubLabelData() as $label) {
            yield $label['label'];
        }
    }
}
