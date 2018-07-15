<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\Push;

use Data\DevboardLib\GitHubWebhook\Core\Push\CommitSample;
use Data\DevboardLib\GitHubWebhook\Core\Push\PusherSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Push\Commit;
use DevboardLib\GitHubWebhook\Core\Push\CommitCollection;
use DevboardLib\GitHubWebhook\Core\Push\CompareChangesUrl;
use DevboardLib\GitHubWebhook\Core\Push\Pusher;
use DevboardLib\GitHubWebhook\Core\Push\Ref;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\Push\CreateBranchPushEvent;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @covers \DevboardLib\GitHubWebhook\Hook\Push\CreateBranchPushEvent
 * @group  unit
 */
class CreateBranchPushEventTest extends TestCase
{
    /** @var Ref */
    private $ref;

    /** @var CommitSha */
    private $after;

    /** @var Ref|null */
    private $baseRef;

    /** @var CompareChangesUrl */
    private $changesUrl;

    /** @var CommitCollection */
    private $commits;

    /** @var Commit */
    private $headCommit;

    /** @var Repo */
    private $repo;

    /** @var bool */
    private $forced;

    /** @var Pusher */
    private $pusher;

    /** @var Sender */
    private $sender;

    /** @var CreateBranchPushEvent */
    private $sut;

    public function setUp(): void
    {
        $this->ref        = new Ref('refs/heads/new-feature');
        $this->after      = new CommitSha('sha');
        $this->baseRef    = new Ref('refs/heads/master');
        $this->changesUrl = new CompareChangesUrl('url');
        $this->commits    = new CommitCollection([CommitSample::abc123()]);
        $this->headCommit = CommitSample::abc123();
        $this->repo       = RepoSample::octocatLinguist();
        $this->forced     = false;
        $this->pusher     = new Pusher(new UserLogin('octocat'), new EmailAddress('octocat@example.com'));
        $this->sender     = SenderSample::octocat();
        $this->sut        = new CreateBranchPushEvent(
            $this->ref,
            $this->after,
            $this->baseRef,
            $this->changesUrl,
            $this->commits,
            $this->headCommit,
            $this->repo,
            $this->forced,
            $this->pusher,
            $this->sender
        );
    }

    public function testGetRef(): void
    {
        self::assertSame($this->ref, $this->sut->getRef());
    }

    public function testGetReferenceName(): void
    {
        self::assertSame('new-feature', $this->sut->getReferenceName());
    }

    public function testGetAfter(): void
    {
        self::assertSame($this->after, $this->sut->getAfter());
    }

    public function testGetBaseRef(): void
    {
        self::assertSame($this->baseRef, $this->sut->getBaseRef());
    }

    public function testGetChangesUrl(): void
    {
        self::assertSame($this->changesUrl, $this->sut->getChangesUrl());
    }

    public function testGetCommits(): void
    {
        self::assertSame($this->commits, $this->sut->getCommits());
    }

    public function testGetHeadCommit(): void
    {
        self::assertSame($this->headCommit, $this->sut->getHeadCommit());
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

    public function testGetPusher(): void
    {
        self::assertSame($this->pusher, $this->sut->getPusher());
    }

    public function testGetSender(): void
    {
        self::assertSame($this->sender, $this->sut->getSender());
    }

    public function testHasBaseRef(): void
    {
        self::assertTrue($this->sut->hasBaseRef());
    }

    public function testSerialize(): void
    {
        $expected = [
            'ref'        => 'refs/heads/new-feature',
            'after'      => 'sha',
            'baseRef'    => 'refs/heads/master',
            'changesUrl' => 'url',
            'commits'    => [CommitSample::serialized('abc123')],
            'headCommit' => CommitSample::serialized('abc123'),
            'repo'       => RepoSample::serialized('octocatLinguist'),
            'forced'     => false,
            'pusher'     => PusherSample::serialized('octocat'),
            'sender'     => SenderSample::serialized('octocat'),
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, CreateBranchPushEvent::deserialize(json_decode($serialized, true)));
    }
}
