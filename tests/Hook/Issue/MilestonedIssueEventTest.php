<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\Issue;

use Data\DevboardLib\GitHubWebhook\Core\Issue\IssueAssigneeSample;
use Data\DevboardLib\GitHubWebhook\Core\Issue\IssueAuthorSample;
use Data\DevboardLib\GitHubWebhook\Core\Label\LabelSample;
use Data\DevboardLib\GitHubWebhook\Core\MilestoneSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\GitHubIssue;
use DevboardLib\GitHub\GitHubLabelCollection;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHub\Issue\IssueApiUrl;
use DevboardLib\GitHub\Issue\IssueAssigneeCollection;
use DevboardLib\GitHub\Issue\IssueBody;
use DevboardLib\GitHub\Issue\IssueClosedAt;
use DevboardLib\GitHub\Issue\IssueCreatedAt;
use DevboardLib\GitHub\Issue\IssueHtmlUrl;
use DevboardLib\GitHub\Issue\IssueId;
use DevboardLib\GitHub\Issue\IssueNumber;
use DevboardLib\GitHub\Issue\IssueState;
use DevboardLib\GitHub\Issue\IssueTitle;
use DevboardLib\GitHub\Issue\IssueUpdatedAt;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\Issue\MilestonedIssueEvent;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @covers \DevboardLib\GitHubWebhook\Hook\Issue\MilestonedIssueEvent
 * @group  unit
 */
class MilestonedIssueEventTest extends TestCase
{
    /** @var GitHubIssue */
    private $issue;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    /** @var MilestonedIssueEvent */
    private $sut;

    public function setUp()
    {
        $this->issue = new GitHubIssue(
            new IssueId(1),
            new IssueNumber(1),
            new IssueTitle('value'),
            new IssueBody('value'),
            IssueState::OPEN(),
            IssueAuthorSample::octocat(),
            new IssueApiUrl('apiUrl'),
            new IssueHtmlUrl('htmlUrl'),
            IssueAssigneeSample::octocat(),
            new IssueAssigneeCollection([IssueAssigneeSample::octocat()]),
            new GitHubLabelCollection([LabelSample::red()]),
            MilestoneSample::sprint1(),
            new IssueClosedAt('2018-01-01T00:01:00+00:00'),
            new IssueCreatedAt('2018-01-01T00:01:00+00:00'),
            new IssueUpdatedAt('2018-01-01T00:01:00+00:00')
        );
        $this->repo           = RepoSample::octocatLinguist();
        $this->installationId = new InstallationId(1);
        $this->sender         = SenderSample::octocat();
        $this->sut            = new MilestonedIssueEvent($this->issue, $this->repo, $this->installationId, $this->sender);
    }

    public function testGetIssue()
    {
        self::assertSame($this->issue, $this->sut->getIssue());
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
            'issue' => [
                'id'        => 1,
                'number'    => 1,
                'title'     => 'value',
                'body'      => 'value',
                'state'     => 'open',
                'author'    => IssueAuthorSample::serialized('octocat'),
                'apiUrl'    => 'apiUrl',
                'htmlUrl'   => 'htmlUrl',
                'assignee'  => IssueAssigneeSample::serialized('octocat'),
                'assignees' => [IssueAssigneeSample::serialized('octocat')],
                'labels'    => [LabelSample::serialized('red')],
                'milestone' => MilestoneSample::serialized('sprint1'),
                'closedAt'  => '2018-01-01T00:01:00+00:00',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ],
            'repo'           => RepoSample::serialized('octocatLinguist'),
            'installationId' => 1,
            'sender'         => SenderSample::serialized('octocat'),
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, MilestonedIssueEvent::deserialize(json_decode($serialized, true)));
    }
}
