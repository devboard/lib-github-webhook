<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\Status;

use DevboardLib\GitHubWebhook\Core\Status\Commit;
use DevboardLib\GitHubWebhook\CoreFactory\Status\CommitFactory;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\Status\CommitFactory
 */
class CommitFactoryTest extends TestCase
{
    private $sut;

    public function setUp()
    {
        $this->sut = self::instance();
    }

    /** @group stagingData */
    public function testCommitFactory()
    {
        $provider = new StagingDataProvider();

        foreach ($provider->getGitHubStatusData() as $item) {
            $commit = $this->sut->create($item['commit']);

            self::assertInstanceOf(Commit::class, $commit);
        }
    }

    public static function instance(): CommitFactory
    {
        return new CommitFactory();
    }
}
