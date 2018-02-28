<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\PullRequest;

use Data\DevboardLib\GitHubWebhook\Core\Label\LabelSample;
use Data\DevboardLib\GitHubWebhook\Core\MilestoneSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAssigneeSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAuthorSample;
use DevboardLib\GitHub\GitHubLabelCollection;
use DevboardLib\GitHub\GitHubMilestone;
use DevboardLib\GitHub\PullRequest\PullRequestApiUrl;
use DevboardLib\GitHub\PullRequest\PullRequestAssignee;
use DevboardLib\GitHub\PullRequest\PullRequestAssigneeCollection;
use DevboardLib\GitHub\PullRequest\PullRequestAuthor;
use DevboardLib\GitHub\PullRequest\PullRequestBody;
use DevboardLib\GitHub\PullRequest\PullRequestClosedAt;
use DevboardLib\GitHub\PullRequest\PullRequestCreatedAt;
use DevboardLib\GitHub\PullRequest\PullRequestHtmlUrl;
use DevboardLib\GitHub\PullRequest\PullRequestId;
use DevboardLib\GitHub\PullRequest\PullRequestNumber;
use DevboardLib\GitHub\PullRequest\PullRequestState;
use DevboardLib\GitHub\PullRequest\PullRequestTitle;
use DevboardLib\GitHub\PullRequest\PullRequestUpdatedAt;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @covers \DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest
 * @group  unit
 */
class PullRequestTest extends TestCase
{
    /** @var PullRequestId */
    private $id;

    /** @var PullRequestNumber */
    private $number;

    /** @var PullRequestTitle */
    private $title;

    /** @var PullRequestBody */
    private $body;

    /** @var PullRequestState */
    private $state;

    /** @var PullRequestAuthor */
    private $author;

    /** @var PullRequestApiUrl */
    private $apiUrl;

    /** @var PullRequestHtmlUrl */
    private $htmlUrl;

    /** @var PullRequestAssignee|null */
    private $assignee;

    /** @var PullRequestAssigneeCollection */
    private $assignees;

    /** @var GitHubLabelCollection */
    private $labels;

    /** @var GitHubMilestone|null */
    private $milestone;

    /** @var PullRequestClosedAt|null */
    private $closedAt;

    /** @var PullRequestCreatedAt */
    private $createdAt;

    /** @var PullRequestUpdatedAt */
    private $updatedAt;

    /** @var PullRequest */
    private $sut;

    public function setUp()
    {
        $this->id        = new PullRequestId(1);
        $this->number    = new PullRequestNumber(1);
        $this->title     = new PullRequestTitle('value');
        $this->body      = new PullRequestBody('value');
        $this->state     = PullRequestState::OPEN();
        $this->author    = PullRequestAuthorSample::octocat();
        $this->apiUrl    = new PullRequestApiUrl('apiUrl');
        $this->htmlUrl   = new PullRequestHtmlUrl('htmlUrl');
        $this->assignee  = PullRequestAssigneeSample::octocat();
        $this->assignees = new PullRequestAssigneeCollection([PullRequestAssigneeSample::octocat()]);
        $this->labels    = new GitHubLabelCollection([LabelSample::red()]);
        $this->milestone = MilestoneSample::sprint1();
        $this->closedAt  = new PullRequestClosedAt('2018-01-01T00:01:00+00:00');
        $this->createdAt = new PullRequestCreatedAt('2018-01-01T00:01:00+00:00');
        $this->updatedAt = new PullRequestUpdatedAt('2018-01-01T00:01:00+00:00');
        $this->sut       = new PullRequest(
            $this->id,
            $this->number,
            $this->title,
            $this->body,
            $this->state,
            $this->author,
            $this->apiUrl,
            $this->htmlUrl,
            $this->assignee,
            $this->assignees,
            $this->labels,
            $this->milestone,
            $this->closedAt,
            $this->createdAt,
            $this->updatedAt
        );
    }

    public function testGetId()
    {
        self::assertSame($this->id, $this->sut->getId());
    }

    public function testGetNumber()
    {
        self::assertSame($this->number, $this->sut->getNumber());
    }

    public function testGetTitle()
    {
        self::assertSame($this->title, $this->sut->getTitle());
    }

    public function testGetBody()
    {
        self::assertSame($this->body, $this->sut->getBody());
    }

    public function testGetState()
    {
        self::assertSame($this->state, $this->sut->getState());
    }

    public function testGetAuthor()
    {
        self::assertSame($this->author, $this->sut->getAuthor());
    }

    public function testGetApiUrl()
    {
        self::assertSame($this->apiUrl, $this->sut->getApiUrl());
    }

    public function testGetHtmlUrl()
    {
        self::assertSame($this->htmlUrl, $this->sut->getHtmlUrl());
    }

    public function testGetAssignee()
    {
        self::assertSame($this->assignee, $this->sut->getAssignee());
    }

    public function testGetAssignees()
    {
        self::assertSame($this->assignees, $this->sut->getAssignees());
    }

    public function testGetLabels()
    {
        self::assertSame($this->labels, $this->sut->getLabels());
    }

    public function testGetMilestone()
    {
        self::assertSame($this->milestone, $this->sut->getMilestone());
    }

    public function testGetClosedAt()
    {
        self::assertSame($this->closedAt, $this->sut->getClosedAt());
    }

    public function testGetCreatedAt()
    {
        self::assertSame($this->createdAt, $this->sut->getCreatedAt());
    }

    public function testGetUpdatedAt()
    {
        self::assertSame($this->updatedAt, $this->sut->getUpdatedAt());
    }

    public function testHasAssignee()
    {
        self::assertTrue($this->sut->hasAssignee());
    }

    public function testHasMilestone()
    {
        self::assertTrue($this->sut->hasMilestone());
    }

    public function testHasClosedAt()
    {
        self::assertTrue($this->sut->hasClosedAt());
    }

    public function testSerialize()
    {
        $expected = [
            'id'        => 1,
            'number'    => 1,
            'title'     => 'value',
            'body'      => 'value',
            'state'     => 'open',
            'author'    => PullRequestAuthorSample::serialized('octocat'),
            'apiUrl'    => 'apiUrl',
            'htmlUrl'   => 'htmlUrl',
            'assignee'  => PullRequestAssigneeSample::serialized('octocat'),
            'assignees' => [PullRequestAssigneeSample::serialized('octocat')],
            'labels'    => [LabelSample::serialized('red')],
            'milestone' => MilestoneSample::serialized('sprint1'),
            'closedAt'  => '2018-01-01T00:01:00+00:00',
            'createdAt' => '2018-01-01T00:01:00+00:00',
            'updatedAt' => '2018-01-01T00:01:00+00:00',
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, PullRequest::deserialize(json_decode($serialized, true)));
    }
}
