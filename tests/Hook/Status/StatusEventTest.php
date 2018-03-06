<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\Status;

use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use Data\DevboardLib\GitHubWebhook\Core\Status\CommitSample;
use DateTime;
use DevboardLib\Generix\GravatarId;
use DevboardLib\Git\Branch\BranchName;
use DevboardLib\GitHub\Account\AccountApiUrl;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountHtmlUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\External\Service\ContinuousIntegration\CircleCi;
use DevboardLib\GitHub\GitHubStatus;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHub\Status\State\Pending;
use DevboardLib\GitHub\Status\StatusContext;
use DevboardLib\GitHub\Status\StatusCreator;
use DevboardLib\GitHub\Status\StatusDescription;
use DevboardLib\GitHub\Status\StatusId;
use DevboardLib\GitHub\Status\StatusTargetUrl;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Core\Status\BranchNameCollection;
use DevboardLib\GitHubWebhook\Core\Status\Commit;
use DevboardLib\GitHubWebhook\Hook\Status\StatusEvent;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @covers \DevboardLib\GitHubWebhook\Hook\Status\StatusEvent
 * @group  unit
 */
class StatusEventTest extends TestCase
{
    /** @var GitHubStatus */
    private $status;

    /** @var Commit */
    private $commit;

    /** @var Repo */
    private $repo;

    /** @var BranchNameCollection */
    private $branches;

    /** @var Sender */
    private $sender;

    /** @var StatusEvent */
    private $sut;

    public function setUp()
    {
        $this->status = new GitHubStatus(
            new StatusId(1),
            new Pending(),
            new StatusDescription('value'),
            new StatusTargetUrl('targetUrl'),
            new StatusContext('description'),
            new CircleCi(new StatusContext('ci/circleci')),
            new StatusCreator(
                new AccountId(1),
                new AccountLogin('value'),
                AccountType::USER(),
                new AccountAvatarUrl('avatarUrl'),
                new GravatarId('id'),
                new AccountHtmlUrl('htmlUrl'),
                new AccountApiUrl('apiUrl'),
                true
            ),
            new DateTime('2018-01-01T00:01:00+00:00'),
            new DateTime('2018-01-01T00:01:00+00:00')
        );
        $this->commit   = CommitSample::abc234();
        $this->repo     = RepoSample::octocatLinguist();
        $this->branches = new BranchNameCollection([new BranchName('name')]);
        $this->sender   = SenderSample::octocat();
        $this->sut      = new StatusEvent($this->status, $this->commit, $this->repo, $this->branches, $this->sender);
    }

    public function testGetStatus()
    {
        self::assertSame($this->status, $this->sut->getStatus());
    }

    public function testGetCommit()
    {
        self::assertSame($this->commit, $this->sut->getCommit());
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

    public function testGetSender()
    {
        self::assertSame($this->sender, $this->sut->getSender());
    }

    public function testSerialize()
    {
        $expected = [
            'status' => [
                'id'              => 1,
                'state'           => 'pending',
                'description'     => 'value',
                'targetUrl'       => 'targetUrl',
                'context'         => 'description',
                'externalService' => [
                    'context'   => 'ci/circleci',
                    'className' => 'DevboardLib\GitHub\External\Service\ContinuousIntegration\CircleCi',
                ],
                'creator' => [
                    'userId'     => 1,
                    'login'      => 'value',
                    'type'       => 'User',
                    'avatarUrl'  => 'avatarUrl',
                    'gravatarId' => 'id',
                    'htmlUrl'    => 'htmlUrl',
                    'apiUrl'     => 'apiUrl',
                    'siteAdmin'  => true,
                ],
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ],
            'commit'   => CommitSample::serialized('abc234'),
            'repo'     => RepoSample::serialized('octocatLinguist'),
            'branches' => ['name'],
            'sender'   => SenderSample::serialized('octocat'),
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, StatusEvent::deserialize(json_decode($serialized, true)));
    }
}
