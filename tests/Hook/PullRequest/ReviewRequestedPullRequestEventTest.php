<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\PullRequest;

use Data\DevboardLib\GitHubWebhook\Core\PullRequestSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHub\PullRequest\PullRequestReviewer;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\PullRequest\ReviewRequestedPullRequestEvent;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @covers \DevboardLib\GitHubWebhook\Hook\PullRequest\ReviewRequestedPullRequestEvent
 * @group  unit
 */
class ReviewRequestedPullRequestEventTest extends TestCase
{
    /** @var PullRequest */
    private $pullRequest;

    /** @var PullRequestReviewer */
    private $reviewer;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    /** @var ReviewRequestedPullRequestEvent */
    private $sut;

    public function setUp()
    {
        $this->pullRequest = PullRequestSample::pr1();
        $this->reviewer    = new PullRequestReviewer(
            new AccountId(1),
            new AccountLogin('value'),
            AccountType::USER(),
            new AccountAvatarUrl('avatarUrl'),
            true
        );
        $this->repo           = RepoSample::octocatLinguist();
        $this->installationId = new InstallationId(1);
        $this->sender         = SenderSample::octocat();
        $this->sut            = new ReviewRequestedPullRequestEvent(
            $this->pullRequest, $this->reviewer, $this->repo, $this->installationId, $this->sender
        );
    }

    public function testGetPullRequest()
    {
        self::assertSame($this->pullRequest, $this->sut->getPullRequest());
    }

    public function testGetReviewer()
    {
        self::assertSame($this->reviewer, $this->sut->getReviewer());
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

    public function testGetInstallationId()
    {
        self::assertSame($this->installationId, $this->sut->getInstallationId());
    }

    public function testGetSender()
    {
        self::assertSame($this->sender, $this->sut->getSender());
    }

    public function testSerialize()
    {
        $expected = [
            'pullRequest' => PullRequestSample::serialized('pr1'),
            'reviewer'    => [
                'userId'    => 1,
                'login'     => 'value',
                'type'      => 'User',
                'avatarUrl' => 'avatarUrl',
                'siteAdmin' => true,
            ],
            'repo'           => RepoSample::serialized('octocatLinguist'),
            'installationId' => 1,
            'sender'         => SenderSample::serialized('octocat'),
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, ReviewRequestedPullRequestEvent::deserialize(json_decode($serialized, true)));
    }
}
