<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\PullRequestReview;

use Data\DevboardLib\GitHubWebhook\Core\PullRequestReviewSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequestSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReview;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\PullRequestReview\SubmittedPullRequestReview;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @covers \DevboardLib\GitHubWebhook\Hook\PullRequestReview\SubmittedPullRequestReview
 * @group  todo
 */
class SubmittedPullRequestReviewTest extends TestCase
{
    /** @var PullRequestReview */
    private $review;

    /** @var PullRequest */
    private $pullRequest;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    /** @var SubmittedPullRequestReview */
    private $sut;

    public function setUp(): void
    {
        $this->review         = PullRequestReviewSample::rev1();
        $this->pullRequest    = PullRequestSample::pr1();
        $this->repo           = RepoSample::octocatLinguist();
        $this->installationId = new InstallationId(1);
        $this->sender         = SenderSample::octocat();
        $this->sut            = new SubmittedPullRequestReview(
            $this->review, $this->pullRequest, $this->repo, $this->installationId, $this->sender
        );
    }

    public function testGetReview(): void
    {
        self::assertSame($this->review, $this->sut->getReview());
    }

    public function testGetPullRequest(): void
    {
        self::assertSame($this->pullRequest, $this->sut->getPullRequest());
    }

    public function testGetRepo(): void
    {
        self::assertSame($this->repo, $this->sut->getRepo());
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
            'review'         => PullRequestReviewSample::serialized('rev1'),
            'pullRequest'    => PullRequestSample::serialized('pr1'),
            'repo'           => RepoSample::serialized('octocatLinguist'),
            'installationId' => 1,
            'sender'         => SenderSample::serialized('octocat'),
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, SubmittedPullRequestReview::deserialize(json_decode($serialized, true)));
    }
}
