<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\HookFactory\Label;

use DevboardLib\GitHubWebhook\CoreFactory\Label\GitHubLabelFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\Label\LabelEvent;
use DevboardLib\GitHubWebhook\HookFactory\Label\LabelEventFactory;
use Generator;
use PHPUnit\Framework\TestCase;
use Tests\DevboardLib\GitHubWebhook\CoreFactory\RepoFactoryTest;
use Tests\DevboardLib\GitHubWebhook\StagingDataProvider;

/**
 * @covers \DevboardLib\GitHubWebhook\HookFactory\Label\LabelEventFactory
 * @group  unit
 */
class LabelEventFactoryTest extends TestCase
{
    /** @var LabelEventFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = self::instance();
    }

    public function testCreate()
    {
        foreach ($this->provideData() as $data) {
            self::assertInstanceOf(LabelEvent::class, $this->sut->create($data));
        }
    }

    public function provideData(): Generator
    {
        foreach ((new StagingDataProvider())->getGitHubLabelData() as $label) {
            yield $label;
        }
    }

    public static function instance(): LabelEventFactory
    {
        return new LabelEventFactory(new GitHubLabelFactory(), RepoFactoryTest::instance(), new SenderFactory());
    }
}
