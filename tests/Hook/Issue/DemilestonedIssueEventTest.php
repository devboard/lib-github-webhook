<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\Issue;

use Data\DevboardLib\GitHubWebhook\Core\Issue\IssueAssigneeSample;
use Data\DevboardLib\GitHubWebhook\Core\Issue\IssueAuthorSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\Generix\GravatarId;
use DevboardLib\GitHub\Account\AccountApiUrl;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountHtmlUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\GitHubIssue;
use DevboardLib\GitHub\GitHubLabel;
use DevboardLib\GitHub\GitHubLabelCollection;
use DevboardLib\GitHub\GitHubMilestone;
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
use DevboardLib\GitHub\Label\LabelApiUrl;
use DevboardLib\GitHub\Label\LabelColor;
use DevboardLib\GitHub\Label\LabelId;
use DevboardLib\GitHub\Label\LabelName;
use DevboardLib\GitHub\Milestone\MilestoneApiUrl;
use DevboardLib\GitHub\Milestone\MilestoneClosedAt;
use DevboardLib\GitHub\Milestone\MilestoneCreatedAt;
use DevboardLib\GitHub\Milestone\MilestoneCreator;
use DevboardLib\GitHub\Milestone\MilestoneDescription;
use DevboardLib\GitHub\Milestone\MilestoneDueOn;
use DevboardLib\GitHub\Milestone\MilestoneHtmlUrl;
use DevboardLib\GitHub\Milestone\MilestoneId;
use DevboardLib\GitHub\Milestone\MilestoneNumber;
use DevboardLib\GitHub\Milestone\MilestoneState;
use DevboardLib\GitHub\Milestone\MilestoneTitle;
use DevboardLib\GitHub\Milestone\MilestoneUpdatedAt;
use DevboardLib\GitHub\User\UserId;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\Issue\DemilestonedIssueEvent;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @covers \DevboardLib\GitHubWebhook\Hook\Issue\DemilestonedIssueEvent
 * @group  todo
 */
class DemilestonedIssueEventTest extends TestCase
{
    /** @var GitHubIssue */
    private $issue;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    /** @var DemilestonedIssueEvent */
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
            new GitHubLabelCollection(
                [
                    new GitHubLabel(
                        new LabelId(1),
                        new LabelName('value'),
                        new LabelColor('color'),
                        true,
                        new LabelApiUrl('apiUrl')
                    ),
                ]
            ),
            new GitHubMilestone(
                new MilestoneId(1),
                new MilestoneTitle('value'),
                new MilestoneDescription('value'),
                new MilestoneDueOn('2018-01-01T00:01:00+00:00'),
                MilestoneState::OPEN(),
                new MilestoneNumber(1),
                new MilestoneCreator(
                    new AccountId(1),
                    new AccountLogin('value'),
                    AccountType::USER(),
                    new AccountAvatarUrl('avatarUrl'),
                    new GravatarId('id'),
                    new AccountHtmlUrl('htmlUrl'),
                    new AccountApiUrl('apiUrl'),
                    true
                ),
                new MilestoneHtmlUrl('htmlUrl'),
                new MilestoneApiUrl('apiUrl'),
                new MilestoneClosedAt('2018-01-01T00:01:00+00:00'),
                new MilestoneCreatedAt('2018-01-01T00:01:00+00:00'),
                new MilestoneUpdatedAt('2018-01-01T00:01:00+00:00')
            ),
            new IssueClosedAt('2018-01-01T00:01:00+00:00'),
            new IssueCreatedAt('2018-01-01T00:01:00+00:00'),
            new IssueUpdatedAt('2018-01-01T00:01:00+00:00')
        );
        $this->repo           = RepoSample::octocatLinguist();
        $this->installationId = new InstallationId(1);
        $this->sender         = SenderSample::octocat();
        $this->sut            = new DemilestonedIssueEvent($this->issue, $this->repo, $this->installationId, $this->sender);
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
                'labels'    => [
                    ['id' => 1, 'name' => 'value', 'color' => 'color', 'default' => true, 'apiUrl' => 'apiUrl'],
                ],
                'milestone' => [
                    'id'          => 1,
                    'title'       => 'value',
                    'description' => 'value',
                    'dueOn'       => '2018-01-01T00:01:00+00:00',
                    'state'       => 'open',
                    'number'      => 1,
                    'creator'     => [
                        'userId'     => 1,
                        'login'      => 'value',
                        'type'       => 'User',
                        'avatarUrl'  => 'avatarUrl',
                        'gravatarId' => 'id',
                        'htmlUrl'    => 'htmlUrl',
                        'apiUrl'     => 'apiUrl',
                        'siteAdmin'  => true,
                    ],
                    'htmlUrl'   => 'htmlUrl',
                    'apiUrl'    => 'apiUrl',
                    'closedAt'  => '2018-01-01T00:01:00+00:00',
                    'createdAt' => '2018-01-01T00:01:00+00:00',
                    'updatedAt' => '2018-01-01T00:01:00+00:00',
                ],
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
        self::assertEquals($this->sut, DemilestonedIssueEvent::deserialize(json_decode($serialized, true)));
    }
}