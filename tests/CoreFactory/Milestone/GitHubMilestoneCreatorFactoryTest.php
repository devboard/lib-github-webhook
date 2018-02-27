<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\Milestone;

use DevboardLib\GitHubWebhook\CoreFactory\Milestone\GitHubMilestoneCreatorFactory;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\Milestone\GitHubMilestoneCreatorFactory
 * @group todo
 */
class GitHubMilestoneCreatorFactoryTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var GitHubMilestoneCreatorFactory */
    private $gitHubMilestoneCreatorFactory;

    public function setUp()
    {
        $this->gitHubMilestoneCreatorFactory = new GitHubMilestoneCreatorFactory();
    }

    public function testCreate()
    {
        $this->markTestSkipped('Skipping');
    }
}
