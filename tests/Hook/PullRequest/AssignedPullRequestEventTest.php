<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\PullRequest;

use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAssigneeSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequestSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHub\PullRequest\PullRequestAssignee;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\PullRequest\AssignedPullRequestEvent;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Hook\PullRequest\AssignedPullRequestEvent
 * @group  unit
 */
class AssignedPullRequestEventTest extends TestCase
{
    /** @var PullRequest */
    private $pullRequest;

    /** @var PullRequestAssignee */
    private $assignee;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    /** @var AssignedPullRequestEvent */
    private $sut;

    public function setUp(): void
    {
        $this->pullRequest    = PullRequestSample::pr1();
        $this->assignee       = PullRequestAssigneeSample::octocat();
        $this->repo           = RepoSample::octocatLinguist();
        $this->installationId = new InstallationId(1);
        $this->sender         = SenderSample::octocat();
        $this->sut            = new AssignedPullRequestEvent(
            $this->pullRequest, $this->assignee, $this->repo, $this->installationId, $this->sender
        );
    }

    public function testGetPullRequest(): void
    {
        self::assertSame($this->pullRequest, $this->sut->getPullRequest());
    }

    public function testGetAssignee(): void
    {
        self::assertSame($this->assignee, $this->sut->getAssignee());
    }

    public function testGetRepo(): void
    {
        self::assertSame($this->repo, $this->sut->getRepo());
    }

    public function testGetRepoId(): void
    {
        self::assertEquals(new RepoId(64778136), $this->sut->getRepoId());
    }

    public function testGetRepoFullName(): void
    {
        self::assertEquals(RepoFullName::createFromString('octocat/linguist'), $this->sut->getRepoFullName());
    }

    public function testGetInstallationId(): void
    {
        self::assertSame($this->installationId, $this->sut->getInstallationId());
    }

    public function testGetSender(): void
    {
        self::assertSame($this->sender, $this->sut->getSender());
    }

    public function testSerialize(): void
    {
        $expected = [
            'pullRequest'    => PullRequestSample::serialized('pr1'),
            'assignee'       => PullRequestAssigneeSample::serialized('octocat'),
            'repo'           => RepoSample::serialized('octocatLinguist'),
            'installationId' => 1,
            'sender'         => SenderSample::serialized('octocat'),
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, AssignedPullRequestEvent::deserialize(json_decode($serialized, true)));
    }
}
