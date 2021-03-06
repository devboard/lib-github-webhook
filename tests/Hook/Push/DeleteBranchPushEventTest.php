<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\Push;

use Data\DevboardLib\GitHubWebhook\Core\Push\PusherSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Push\Pusher;
use DevboardLib\GitHubWebhook\Core\Push\Ref;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\Push\DeleteBranchPushEvent;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @covers \DevboardLib\GitHubWebhook\Hook\Push\DeleteBranchPushEvent
 * @group  unit
 */
class DeleteBranchPushEventTest extends TestCase
{
    /** @var Ref */
    private $ref;

    /** @var CommitSha */
    private $before;

    /** @var Repo */
    private $repo;

    /** @var bool */
    private $forced;

    /** @var Pusher */
    private $pusher;

    /** @var Sender */
    private $sender;

    /** @var DeleteBranchPushEvent */
    private $sut;

    public function setUp(): void
    {
        $this->ref    = new Ref('refs/heads/new-feature-branch');
        $this->before = new CommitSha('sha');
        $this->repo   = RepoSample::octocatLinguist();
        $this->forced = false;
        $this->pusher = new Pusher(new UserLogin('octocat'), new EmailAddress('octocat@example.com'));
        $this->sender = SenderSample::octocat();
        $this->sut    = new DeleteBranchPushEvent(
            $this->ref, $this->before, $this->repo, $this->forced, $this->pusher, $this->sender
        );
    }

    public function testGetRef(): void
    {
        self::assertSame($this->ref, $this->sut->getRef());
    }

    public function testGetReferenceName(): void
    {
        self::assertSame('new-feature-branch', $this->sut->getReferenceName());
    }

    public function testGetBefore(): void
    {
        self::assertSame($this->before, $this->sut->getBefore());
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

    public function testSerialize(): void
    {
        $expected = [
            'ref'    => 'refs/heads/new-feature-branch',
            'before' => 'sha',
            'repo'   => RepoSample::serialized('octocatLinguist'),
            'forced' => false,
            'pusher' => PusherSample::serialized('octocat'),
            'sender' => SenderSample::serialized('octocat'),
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, DeleteBranchPushEvent::deserialize(json_decode($serialized, true)));
    }
}
