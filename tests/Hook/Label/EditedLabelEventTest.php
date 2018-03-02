<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\Label;

use Data\DevboardLib\GitHubWebhook\Core\Label\LabelSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\GitHubLabel;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\Label\EditedLabelEvent;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @covers \DevboardLib\GitHubWebhook\Hook\Label\EditedLabelEvent
 * @group  unit
 */
class EditedLabelEventTest extends TestCase
{
    /** @var GitHubLabel */
    private $label;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    /** @var EditedLabelEvent */
    private $sut;

    public function setUp()
    {
        $this->label          = LabelSample::red();
        $this->repo           = RepoSample::octocatLinguist();
        $this->installationId = new InstallationId(1);
        $this->sender         = SenderSample::octocat();
        $this->sut            = new EditedLabelEvent($this->label, $this->repo, $this->installationId, $this->sender);
    }

    public function testGetLabel()
    {
        self::assertSame($this->label, $this->sut->getLabel());
    }

    public function testGetRepo()
    {
        self::assertSame($this->repo, $this->sut->getRepo());
    }

    public function testGetInstallationId()
    {
        self::assertSame($this->installationId, $this->sut->getInstallationId());
    }

    public function testGetSender()
    {
        self::assertSame($this->sender, $this->sut->getSender());
    }

    public function testSerialize()
    {
        $expected = [
            'label'          => LabelSample::serialized('red'),
            'repo'           => RepoSample::serialized('octocatLinguist'),
            'installationId' => 1,
            'sender'         => SenderSample::serialized('octocat'),
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, EditedLabelEvent::deserialize(json_decode($serialized, true)));
    }
}
