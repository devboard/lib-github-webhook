<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\PullRequest;

use Data\DevboardLib\GitHubWebhook\Core\Label\LabelSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequestSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\GitHubLabel;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\PullRequest\LabeledPullRequestEvent;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @covers \DevboardLib\GitHubWebhook\Hook\PullRequest\LabeledPullRequestEvent
 * @group  unit
 */
class LabeledPullRequestEventTest extends TestCase
{
    /** @var PullRequest */
    private $pullRequest;

    /** @var GitHubLabel */
    private $label;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    /** @var LabeledPullRequestEvent */
    private $sut;

    public function setUp()
    {
        $this->pullRequest    = PullRequestSample::pr1();
        $this->label          = LabelSample::red();
        $this->repo           = RepoSample::octocatLinguist();
        $this->installationId = new InstallationId(1);
        $this->sender         = SenderSample::octocat();
        $this->sut            = new LabeledPullRequestEvent(
            $this->pullRequest, $this->label, $this->repo, $this->installationId, $this->sender
        );
    }

    public function testGetPullRequest()
    {
        self::assertSame($this->pullRequest, $this->sut->getPullRequest());
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
            'pullRequest'    => PullRequestSample::serialized('pr1'),
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
        self::assertEquals($this->sut, LabeledPullRequestEvent::deserialize(json_decode($serialized, true)));
    }
}
