<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\PullRequest;

use Data\DevboardLib\GitHubWebhook\Core\MilestoneSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAssigneeSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAuthorSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequestBaseSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequestHeadSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequestMergedBySample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequestRequestedReviewerSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequestUrlsSample;
use DateTime;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHub\GitHubMilestone;
use DevboardLib\GitHub\PullRequest\PullRequestAssigneeCollection;
use DevboardLib\GitHub\PullRequest\PullRequestAuthor;
use DevboardLib\GitHub\PullRequest\PullRequestBody;
use DevboardLib\GitHub\PullRequest\PullRequestClosedAt;
use DevboardLib\GitHub\PullRequest\PullRequestCreatedAt;
use DevboardLib\GitHub\PullRequest\PullRequestId;
use DevboardLib\GitHub\PullRequest\PullRequestNumber;
use DevboardLib\GitHub\PullRequest\PullRequestState;
use DevboardLib\GitHub\PullRequest\PullRequestTitle;
use DevboardLib\GitHub\PullRequest\PullRequestUpdatedAt;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestBase;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestHead;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestMergedBy;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedReviewerCollection;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeam;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeamCollection;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestStats;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestUrls;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.TooManyFields)
 *
 * @covers \DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest
 * @group  unit
 */
class PullRequestTest extends TestCase
{
    /** @var PullRequestId */
    private $id;

    /** @var PullRequestNumber */
    private $number;

    /** @var PullRequestBase */
    private $base;

    /** @var PullRequestHead */
    private $head;

    /** @var PullRequestTitle */
    private $title;

    /** @var PullRequestBody */
    private $body;

    /** @var PullRequestState */
    private $state;

    /** @var PullRequestAuthor */
    private $author;

    /** @var PullRequestAssigneeCollection */
    private $assignees;

    /** @var PullRequestRequestedReviewerCollection */
    private $requestedReviewers;

    /** @var PullRequestRequestedTeamCollection */
    private $requestedTeams;

    /** @var bool */
    private $locked;

    /** @var bool|null */
    private $rebaseable;

    /** @var bool */
    private $maintainerCanModify;

    /** @var CommitSha|null */
    private $mergeCommitSha;

    /** @var bool|null */
    private $mergeable;

    /** @var string */
    private $mergeableState;

    /** @var bool */
    private $merged;

    /** @var DateTime|null */
    private $mergedAt;

    /** @var PullRequestMergedBy|null */
    private $mergedBy;

    /** @var GitHubMilestone|null */
    private $milestone;

    /** @var PullRequestClosedAt|null */
    private $closedAt;

    /** @var PullRequestStats */
    private $stats;

    /** @var PullRequestUrls */
    private $urls;

    /** @var PullRequestCreatedAt */
    private $createdAt;

    /** @var PullRequestUpdatedAt */
    private $updatedAt;

    /** @var PullRequest */
    private $sut;

    public function setUp(): void
    {
        $this->id                 = new PullRequestId(1);
        $this->number             = new PullRequestNumber(1);
        $this->base               = PullRequestBaseSample::base1();
        $this->head               = PullRequestHeadSample::head1();
        $this->title              = new PullRequestTitle('value');
        $this->body               = new PullRequestBody('value');
        $this->state              = PullRequestState::OPEN();
        $this->author             = PullRequestAuthorSample::octocat();
        $this->assignees          = new PullRequestAssigneeCollection([PullRequestAssigneeSample::octocat()]);
        $this->requestedReviewers = new PullRequestRequestedReviewerCollection(
            [PullRequestRequestedReviewerSample::octocat()]
        );
        $this->requestedTeams      = new PullRequestRequestedTeamCollection([new PullRequestRequestedTeam('todo')]);
        $this->locked              = true;
        $this->rebaseable          = true;
        $this->maintainerCanModify = true;
        $this->mergeCommitSha      = new CommitSha('sha');
        $this->mergeable           = true;
        $this->mergeableState      = 'mergeableState';
        $this->merged              = true;
        $this->mergedAt            = new DateTime('2018-01-01T00:01:00+00:00');
        $this->mergedBy            = PullRequestMergedBySample::octocat();
        $this->milestone           = MilestoneSample::sprint1();
        $this->closedAt            = new PullRequestClosedAt('2018-01-01T00:01:00+00:00');
        $this->stats               = new PullRequestStats(1, 1, 1, 1, 1);
        $this->urls                = PullRequestUrlsSample::urls1();
        $this->createdAt           = new PullRequestCreatedAt('2018-01-01T00:01:00+00:00');
        $this->updatedAt           = new PullRequestUpdatedAt('2018-01-01T00:01:00+00:00');
        $this->sut                 = new PullRequest(
            $this->id,
            $this->number,
            $this->base,
            $this->head,
            $this->title,
            $this->body,
            $this->state,
            $this->author,
            $this->assignees,
            $this->requestedReviewers,
            $this->requestedTeams,
            $this->locked,
            $this->rebaseable,
            $this->maintainerCanModify,
            $this->mergeCommitSha,
            $this->mergeable,
            $this->mergeableState,
            $this->merged,
            $this->mergedAt,
            $this->mergedBy,
            $this->milestone,
            $this->closedAt,
            $this->stats,
            $this->urls,
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

    public function testGetBase(): void
    {
        self::assertSame($this->base, $this->sut->getBase());
    }

    public function testGetHead(): void
    {
        self::assertSame($this->head, $this->sut->getHead());
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

    public function testGetRequestedReviewers(): void
    {
        self::assertSame($this->requestedReviewers, $this->sut->getRequestedReviewers());
    }

    public function testGetRequestedTeams(): void
    {
        self::assertSame($this->requestedTeams, $this->sut->getRequestedTeams());
    }

    public function testIsLocked(): void
    {
        self::assertSame($this->locked, $this->sut->isLocked());
    }

    public function testIsRebaseable(): void
    {
        self::assertSame($this->rebaseable, $this->sut->isRebaseable());
    }

    public function testIsMaintainerCanModify(): void
    {
        self::assertSame($this->maintainerCanModify, $this->sut->isMaintainerCanModify());
    }

    public function testGetMergeCommitSha(): void
    {
        self::assertSame($this->mergeCommitSha, $this->sut->getMergeCommitSha());
    }

    public function testIsMergeable(): void
    {
        self::assertSame($this->mergeable, $this->sut->isMergeable());
    }

    public function testGetMergeableState(): void
    {
        self::assertSame($this->mergeableState, $this->sut->getMergeableState());
    }

    public function testIsMerged(): void
    {
        self::assertSame($this->merged, $this->sut->isMerged());
    }

    public function testGetMergedAt(): void
    {
        self::assertSame($this->mergedAt, $this->sut->getMergedAt());
    }

    public function testGetMergedBy(): void
    {
        self::assertSame($this->mergedBy, $this->sut->getMergedBy());
    }

    public function testGetMilestone(): void
    {
        self::assertSame($this->milestone, $this->sut->getMilestone());
    }

    public function testGetClosedAt(): void
    {
        self::assertSame($this->closedAt, $this->sut->getClosedAt());
    }

    public function testGetStats(): void
    {
        self::assertSame($this->stats, $this->sut->getStats());
    }

    public function testGetUrls(): void
    {
        self::assertSame($this->urls, $this->sut->getUrls());
    }

    public function testGetCreatedAt(): void
    {
        self::assertSame($this->createdAt, $this->sut->getCreatedAt());
    }

    public function testGetUpdatedAt(): void
    {
        self::assertSame($this->updatedAt, $this->sut->getUpdatedAt());
    }

    public function testHasRebaseable(): void
    {
        self::assertTrue($this->sut->hasRebaseable());
    }

    public function testHasMergeCommitSha(): void
    {
        self::assertTrue($this->sut->hasMergeCommitSha());
    }

    public function testHasMergeable(): void
    {
        self::assertTrue($this->sut->hasMergeable());
    }

    public function testHasMergedAt(): void
    {
        self::assertTrue($this->sut->hasMergedAt());
    }

    public function testHasMergedBy(): void
    {
        self::assertTrue($this->sut->hasMergedBy());
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
            'id'                  => 1,
            'number'              => 1,
            'base'                => PullRequestBaseSample::serialized('base1'),
            'head'                => PullRequestHeadSample::serialized('head1'),
            'title'               => 'value',
            'body'                => 'value',
            'state'               => 'open',
            'author'              => PullRequestAuthorSample::serialized('octocat'),
            'assignees'           => [PullRequestAssigneeSample::serialized('octocat')],
            'requestedReviewers'  => [PullRequestRequestedReviewerSample::serialized('octocat')],
            'requestedTeams'      => ['todo'],
            'locked'              => true,
            'rebaseable'          => true,
            'maintainerCanModify' => true,
            'mergeCommitSha'      => 'sha',
            'mergeable'           => true,
            'mergeableState'      => 'mergeableState',
            'merged'              => true,
            'mergedAt'            => '2018-01-01T00:01:00+00:00',
            'mergedBy'            => PullRequestMergedBySample::serialized('octocat'),
            'milestone'           => MilestoneSample::serialized('sprint1'),
            'closedAt'            => '2018-01-01T00:01:00+00:00',
            'stats'               => ['additions' => 1, 'changedFiles' => 1, 'comments' => 1, 'commits' => 1, 'deletions' => 1],
            'urls'                => PullRequestUrlsSample::serialized('urls1'),
            'createdAt'           => '2018-01-01T00:01:00+00:00',
            'updatedAt'           => '2018-01-01T00:01:00+00:00',
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, PullRequest::deserialize(json_decode($serialized, true)));
    }
}
