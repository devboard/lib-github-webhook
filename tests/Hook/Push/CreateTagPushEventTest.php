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
use DevboardLib\GitHubWebhook\Hook\Push\CreateTagPushEvent;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @covers \DevboardLib\GitHubWebhook\Hook\Push\CreateTagPushEvent
 * @group  unit
 */
class CreateTagPushEventTest extends TestCase
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

    /** @var CreateTagPushEvent */
    private $sut;

    public function setUp()
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
        $this->sut        = new CreateTagPushEvent(
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

    public function testGetRef()
    {
        self::assertSame($this->ref, $this->sut->getRef());
    }

    public function testGetAfter()
    {
        self::assertSame($this->after, $this->sut->getAfter());
    }

    public function testGetBaseRef()
    {
        self::assertSame($this->baseRef, $this->sut->getBaseRef());
    }

    public function testGetChangesUrl()
    {
        self::assertSame($this->changesUrl, $this->sut->getChangesUrl());
    }

    public function testGetCommits()
    {
        self::assertSame($this->commits, $this->sut->getCommits());
    }

    public function testGetHeadCommit()
    {
        self::assertSame($this->headCommit, $this->sut->getHeadCommit());
    }

    public function testGetRepo()
    {
        self::assertSame($this->repo, $this->sut->getRepo());
    }

    public function testGetRepoId()
    {
        self::assertEquals(new RepoId(64778136), $this->sut->getRepoId());
    }

    public function testGetRepoFullName()
    {
        self::assertEquals(RepoFullName::createFromString('octocat/linguist'), $this->sut->getRepoFullName());
    }

    public function testGetPusher()
    {
        self::assertSame($this->pusher, $this->sut->getPusher());
    }

    public function testGetSender()
    {
        self::assertSame($this->sender, $this->sut->getSender());
    }

    public function testHasBaseRef()
    {
        self::assertTrue($this->sut->hasBaseRef());
    }

    public function testSerialize()
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

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, CreateTagPushEvent::deserialize(json_decode($serialized, true)));
    }
}
