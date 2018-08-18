<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\IssueComment;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\GitHubLabel;
use DevboardLib\GitHub\GitHubLabelCollection;
use DevboardLib\GitHub\Issue\IssueBody;
use DevboardLib\GitHub\Issue\IssueClosedAt;
use DevboardLib\GitHub\Issue\IssueCreatedAt;
use DevboardLib\GitHub\Issue\IssueId;
use DevboardLib\GitHub\Issue\IssueNumber;
use DevboardLib\GitHub\Issue\IssueState;
use DevboardLib\GitHub\Issue\IssueTitle;
use DevboardLib\GitHub\Issue\IssueUpdatedAt;
use DevboardLib\GitHub\Label\LabelColor;
use DevboardLib\GitHub\Label\LabelId;
use DevboardLib\GitHub\Label\LabelName;
use DevboardLib\GitHub\Milestone\MilestoneClosedAt;
use DevboardLib\GitHub\Milestone\MilestoneCreatedAt;
use DevboardLib\GitHub\Milestone\MilestoneDescription;
use DevboardLib\GitHub\Milestone\MilestoneDueOn;
use DevboardLib\GitHub\Milestone\MilestoneId;
use DevboardLib\GitHub\Milestone\MilestoneNumber;
use DevboardLib\GitHub\Milestone\MilestoneState;
use DevboardLib\GitHub\Milestone\MilestoneTitle;
use DevboardLib\GitHub\Milestone\MilestoneUpdatedAt;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueAssignee;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueAssigneeCollection;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueAuthor;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueDetails;
use DevboardLib\GitHubWebhook\Core\Milestone\MilestoneCreator;
use DevboardLib\GitHubWebhook\Core\Milestone\MilestoneDetails;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @covers \DevboardLib\GitHubWebhook\Core\IssueComment\IssueDetails
 * @group  todo
 */
class IssueDetailsTest extends TestCase
{
    /** @var IssueId */
    private $id;

    /** @var IssueNumber */
    private $number;

    /** @var IssueTitle */
    private $title;

    /** @var IssueBody */
    private $body;

    /** @var IssueState */
    private $state;

    /** @var IssueAuthor */
    private $author;

    /** @var IssueAssigneeCollection */
    private $assignees;

    /** @var GitHubLabelCollection */
    private $labels;

    /** @var MilestoneDetails|null */
    private $milestone;

    /** @var IssueClosedAt|null */
    private $closedAt;

    /** @var IssueCreatedAt */
    private $createdAt;

    /** @var IssueUpdatedAt */
    private $updatedAt;

    /** @var IssueDetails */
    private $sut;

    public function setUp(): void
    {
        $this->id     = new IssueId(1);
        $this->number = new IssueNumber(1);
        $this->title  = new IssueTitle('value');
        $this->body   = new IssueBody('value');
        $this->state  = IssueState::OPEN();
        $this->author = new IssueAuthor(
            new AccountId(1),
            new AccountLogin('value'),
            AccountType::USER(),
            new AccountAvatarUrl('avatarUrl'),
            true
        );
        $this->assignees = new IssueAssigneeCollection(
            [
                new IssueAssignee(
                    new AccountId(1),
                    new AccountLogin('value'),
                    AccountType::USER(),
                    new AccountAvatarUrl('avatarUrl'),
                    true
                ),
            ]
        );
        $this->labels = new GitHubLabelCollection(
            [new GitHubLabel(new LabelId(1), new LabelName('value'), new LabelColor('color'), true)]
        );
        $this->milestone = new MilestoneDetails(
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
                true
            ),
            new MilestoneClosedAt('2018-01-01T00:01:00+00:00'),
            new MilestoneCreatedAt('2018-01-01T00:01:00+00:00'),
            new MilestoneUpdatedAt('2018-01-01T00:01:00+00:00')
        );
        $this->closedAt  = new IssueClosedAt('2018-01-01T00:01:00+00:00');
        $this->createdAt = new IssueCreatedAt('2018-01-01T00:01:00+00:00');
        $this->updatedAt = new IssueUpdatedAt('2018-01-01T00:01:00+00:00');
        $this->sut       = new IssueDetails(
            $this->id,
            $this->number,
            $this->title,
            $this->body,
            $this->state,
            $this->author,
            $this->assignees,
            $this->labels,
            $this->milestone,
            $this->closedAt,
            $this->createdAt,
            $this->updatedAt
        );
    }

    public function testGetId(): void
    {
        self::assertSame($this->id, $this->sut->getId());
    }

    public function testGetNumber(): void
    {
        self::assertSame($this->number, $this->sut->getNumber());
    }

    public function testGetTitle(): void
    {
        self::assertSame($this->title, $this->sut->getTitle());
    }

    public function testGetBody(): void
    {
        self::assertSame($this->body, $this->sut->getBody());
    }

    public function testGetState(): void
    {
        self::assertSame($this->state, $this->sut->getState());
    }

    public function testGetAuthor(): void
    {
        self::assertSame($this->author, $this->sut->getAuthor());
    }

    public function testGetAssignees(): void
    {
        self::assertSame($this->assignees, $this->sut->getAssignees());
    }

    public function testGetLabels(): void
    {
        self::assertSame($this->labels, $this->sut->getLabels());
    }

    public function testGetMilestone(): void
    {
        self::assertSame($this->milestone, $this->sut->getMilestone());
    }

    public function testGetClosedAt(): void
    {
        self::assertSame($this->closedAt, $this->sut->getClosedAt());
    }

    public function testGetCreatedAt(): void
    {
        self::assertSame($this->createdAt, $this->sut->getCreatedAt());
    }

    public function testGetUpdatedAt(): void
    {
        self::assertSame($this->updatedAt, $this->sut->getUpdatedAt());
    }

    public function testHasMilestone(): void
    {
        self::assertTrue($this->sut->hasMilestone());
    }

    public function testHasClosedAt(): void
    {
        self::assertTrue($this->sut->hasClosedAt());
    }

    public function testSerialize(): void
    {
        $expected = [
            'id'     => 1,
            'number' => 1,
            'title'  => 'value',
            'body'   => 'value',
            'state'  => IssueState::OPEN,
            'author' => [
                'userId'    => 1,
                'login'     => 'value',
                'type'      => 'User',
                'avatarUrl' => 'avatarUrl',
                'siteAdmin' => true,
            ],
            'assignees' => [
                [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
            ],
            'labels'    => [['id' => 1, 'name' => 'value', 'color' => 'color', 'default' => true]],
            'milestone' => [
                'id'          => 1,
                'title'       => 'value',
                'description' => 'value',
                'dueOn'       => '2018-01-01T00:01:00+00:00',
                'state'       => MilestoneState::OPEN,
                'number'      => 1,
                'creator'     => [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
                'closedAt'  => '2018-01-01T00:01:00+00:00',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ],
            'closedAt'  => '2018-01-01T00:01:00+00:00',
            'createdAt' => '2018-01-01T00:01:00+00:00',
            'updatedAt' => '2018-01-01T00:01:00+00:00',
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, IssueDetails::deserialize(json_decode($serialized, true)));
    }
}
