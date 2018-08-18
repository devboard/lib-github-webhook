<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\IssueComment;

use Data\DevboardLib\GitHubWebhook\Core\IssueComment\IssueAssigneeSample;
use Data\DevboardLib\GitHubWebhook\Core\IssueComment\IssueAuthorSample;
use Data\DevboardLib\GitHubWebhook\Core\IssueComment\IssueCommentAuthorSample;
use Data\DevboardLib\GitHubWebhook\Core\Label\LabelSample;
use Data\DevboardLib\GitHubWebhook\Core\MilestoneSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\GitHubLabelCollection;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHub\Issue\IssueBody;
use DevboardLib\GitHub\Issue\IssueClosedAt;
use DevboardLib\GitHub\Issue\IssueCreatedAt;
use DevboardLib\GitHub\Issue\IssueId;
use DevboardLib\GitHub\Issue\IssueNumber;
use DevboardLib\GitHub\Issue\IssueState;
use DevboardLib\GitHub\Issue\IssueTitle;
use DevboardLib\GitHub\Issue\IssueUpdatedAt;
use DevboardLib\GitHub\IssueComment\IssueCommentBody;
use DevboardLib\GitHub\IssueComment\IssueCommentCreatedAt;
use DevboardLib\GitHub\IssueComment\IssueCommentId;
use DevboardLib\GitHub\IssueComment\IssueCommentUpdatedAt;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueAssigneeCollection;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueCommentDetails;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueDetails;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\IssueComment\DeletedIssueCommentEvent;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @covers \DevboardLib\GitHubWebhook\Hook\IssueComment\DeletedIssueCommentEvent
 * @group  unit
 */
class DeletedIssueCommentEventTest extends TestCase
{
    /** @var IssueCommentDetails */
    private $comment;

    /** @var IssueDetails */
    private $issue;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    /** @var DeletedIssueCommentEvent */
    private $sut;

    public function setUp(): void
    {
        $this->comment = new IssueCommentDetails(
            new IssueCommentId(1),
            new IssueId(1),
            new IssueCommentBody('value'),
            IssueCommentAuthorSample::octocat(),
            new IssueCommentCreatedAt('2018-01-01T00:01:00+00:00'),
            new IssueCommentUpdatedAt('2018-01-01T00:01:00+00:00')
        );
        $this->issue = new IssueDetails(
            new IssueId(1),
            new IssueNumber(1),
            new IssueTitle('value'),
            new IssueBody('value'),
            IssueState::OPEN(),
            IssueAuthorSample::octocat(),
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
        $this->sut            = new DeletedIssueCommentEvent(
            $this->comment, $this->issue, $this->repo, $this->installationId, $this->sender
        );
    }

    public function testGetComment(): void
    {
        self::assertSame($this->comment, $this->sut->getComment());
    }

    public function testGetIssue(): void
    {
        self::assertSame($this->issue, $this->sut->getIssue());
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
            'comment' => [
                'id'        => 1,
                'issueId'   => 1,
                'body'      => 'value',
                'author'    => IssueCommentAuthorSample::serialized('octocat'),
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ],
            'issue' => [
                'id'        => 1,
                'number'    => 1,
                'title'     => 'value',
                'body'      => 'value',
                'state'     => 'open',
                'author'    => IssueAuthorSample::serialized('octocat'),
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

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, DeletedIssueCommentEvent::deserialize(json_decode($serialized, true)));
    }
}
