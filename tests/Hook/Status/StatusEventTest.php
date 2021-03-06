<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\Status;

use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use Data\DevboardLib\GitHubWebhook\Core\Status\CommitSample;
use DateTime;
use DevboardLib\Git\Branch\BranchName;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\External\Service\ContinuousIntegration\CircleCi;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHub\StatusCheck\State\Pending;
use DevboardLib\GitHub\StatusCheck\StatusCheckContext;
use DevboardLib\GitHub\StatusCheck\StatusCheckCreator;
use DevboardLib\GitHub\StatusCheck\StatusCheckDescription;
use DevboardLib\GitHub\StatusCheck\StatusCheckId;
use DevboardLib\GitHub\StatusCheck\StatusCheckTargetUrl;
use DevboardLib\GitHubWebhook\Core\GitHubStatusCheck;
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
    /** @var GitHubStatusCheck */
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

    public function setUp(): void
    {
        $this->status = new GitHubStatusCheck(
            new StatusCheckId(1),
            new Pending(),
            new StatusCheckDescription('value'),
            new StatusCheckTargetUrl('targetUrl'),
            new StatusCheckContext('description'),
            new CircleCi(new StatusCheckContext('ci/circleci')),
            new StatusCheckCreator(
                new AccountId(1),
                new AccountLogin('value'),
                AccountType::USER(),
                new AccountAvatarUrl('avatarUrl'),
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

    public function testGetStatus(): void
    {
        self::assertSame($this->status, $this->sut->getStatus());
    }

    public function testGetCommit(): void
    {
        self::assertSame($this->commit, $this->sut->getCommit());
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

    public function testGetSender(): void
    {
        self::assertSame($this->sender, $this->sut->getSender());
    }

    public function testSerialize(): void
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
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
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

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, StatusEvent::deserialize(json_decode($serialized, true)));
    }
}
