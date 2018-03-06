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
use DevboardLib\GitHubWebhook\Hook\Push\DeleteTagPushEvent;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @covers \DevboardLib\GitHubWebhook\Hook\Push\DeleteTagPushEvent
 * @group  unit
 */
class DeleteTagPushEventTest extends TestCase
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

    /** @var DeleteTagPushEvent */
    private $sut;

    public function setUp()
    {
        $this->ref    = new Ref('refs/heads/new-feature-tag');
        $this->before = new CommitSha('sha');
        $this->repo   = RepoSample::octocatLinguist();
        $this->forced = false;
        $this->pusher = new Pusher(new UserLogin('octocat'), new EmailAddress('octocat@example.com'));
        $this->sender = SenderSample::octocat();
        $this->sut    = new DeleteTagPushEvent(
            $this->ref, $this->before, $this->repo, $this->forced, $this->pusher, $this->sender
        );
    }

    public function testGetRef()
    {
        self::assertSame($this->ref, $this->sut->getRef());
    }

    public function testGetReferenceName()
    {
        self::assertSame('new-feature-tag', $this->sut->getReferenceName());
    }

    public function testGetBefore()
    {
        self::assertSame($this->before, $this->sut->getBefore());
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

    public function testSerialize()
    {
        $expected = [
            'ref'    => 'refs/heads/new-feature-tag',
            'before' => 'sha',
            'repo'   => RepoSample::serialized('octocatLinguist'),
            'forced' => false,
            'pusher' => PusherSample::serialized('octocat'),
            'sender' => SenderSample::serialized('octocat'),
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, DeleteTagPushEvent::deserialize(json_decode($serialized, true)));
    }
}
