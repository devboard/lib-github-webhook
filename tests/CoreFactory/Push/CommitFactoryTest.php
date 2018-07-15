<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\Push;

use DevboardLib\GitHubWebhook\Core\Push\Commit;
use DevboardLib\GitHubWebhook\CoreFactory\Push\CommitFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\Push\CommitFactory
 */
class CommitFactoryTest extends TestCase
{
    private $sut;

    public function setUp(): void
    {
        $this->sut = new CommitFactory();
    }

    /** @group stagingData */
    public function testCommitFactoryFromHeadCommitData(): void
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            if (false === array_key_exists('head_commit', $item)) {
                continue;
            }

            if (null === $item['head_commit']) {
                continue;
            }
            $sender = $this->sut->create($item['head_commit']);

            self::assertInstanceOf(Commit::class, $sender);
        }
    }

    /** @group stagingData */
    public function testCommitFactoryFromCommits(): void
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubPushEventData() as $item) {
            foreach ($item['commits'] as $commit) {
                $sender = $this->sut->create($commit);

                self::assertInstanceOf(Commit::class, $sender);
            }
        }
    }
}
