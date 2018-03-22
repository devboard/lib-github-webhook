<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\PullRequestReview;

use DevboardLib\Generix\GravatarId;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHub\Account\AccountApiUrl;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountHtmlUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\PullRequest\PullRequestApiUrl;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewAuthor;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewBody;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewHtmlUrl;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewId;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewState;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewSubmittedAt;
use DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReview;
use DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReviewUrls;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @covers \DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReview
 * @group  todo
 */
class PullRequestReviewTest extends TestCase
{
    /** @var PullRequestReviewId */
    private $id;

    /** @var PullRequestReviewBody */
    private $body;

    /** @var PullRequestReviewAuthor */
    private $author;

    /** @var string|null */
    private $authorAssociation;

    /** @var PullRequestReviewState */
    private $state;

    /** @var CommitSha */
    private $commitSha;

    /** @var PullRequestReviewUrls */
    private $urls;

    /** @var PullRequestReviewSubmittedAt */
    private $submittedAt;

    /** @var PullRequestReview */
    private $sut;

    public function setUp()
    {
        $this->id     = new PullRequestReviewId(1);
        $this->body   = new PullRequestReviewBody('value');
        $this->author = new PullRequestReviewAuthor(
            new AccountId(1),
            new AccountLogin('value'),
            AccountType::USER(),
            new AccountAvatarUrl('avatarUrl'),
            new GravatarId('id'),
            new AccountHtmlUrl('htmlUrl'),
            new AccountApiUrl('apiUrl'),
            true
        );
        $this->authorAssociation = 'authorAssociation';
        $this->state             = new PullRequestReviewState('open');
        $this->commitSha         = new CommitSha('sha');
        $this->urls              = new PullRequestReviewUrls(
            new PullRequestReviewHtmlUrl('htmlUrl'), new PullRequestApiUrl('apiUrl')
        );
        $this->submittedAt = new PullRequestReviewSubmittedAt('2018-01-01T00:01:00+00:00');
        $this->sut         = new PullRequestReview(
            $this->id,
            $this->body,
            $this->author,
            $this->authorAssociation,
            $this->state,
            $this->commitSha,
            $this->urls,
            $this->submittedAt
        );
    }

    public function testGetId()
    {
        self::assertSame($this->id, $this->sut->getId());
    }

    public function testGetBody()
    {
        self::assertSame($this->body, $this->sut->getBody());
    }

    public function testGetAuthor()
    {
        self::assertSame($this->author, $this->sut->getAuthor());
    }

    public function testGetAuthorAssociation()
    {
        self::assertSame($this->authorAssociation, $this->sut->getAuthorAssociation());
    }

    public function testGetState()
    {
        self::assertSame($this->state, $this->sut->getState());
    }

    public function testGetCommitSha()
    {
        self::assertSame($this->commitSha, $this->sut->getCommitSha());
    }

    public function testGetUrls()
    {
        self::assertSame($this->urls, $this->sut->getUrls());
    }

    public function testGetSubmittedAt()
    {
        self::assertSame($this->submittedAt, $this->sut->getSubmittedAt());
    }

    public function testHasAuthorAssociation()
    {
        self::assertTrue($this->sut->hasAuthorAssociation());
    }

    public function testSerialize()
    {
        $expected = [
            'id'     => 1,
            'body'   => 'value',
            'author' => [
                'userId'     => 1,
                'login'      => 'value',
                'type'       => 'User',
                'avatarUrl'  => 'avatarUrl',
                'gravatarId' => 'id',
                'htmlUrl'    => 'htmlUrl',
                'apiUrl'     => 'apiUrl',
                'siteAdmin'  => true,
            ],
            'authorAssociation' => 'authorAssociation',
            'state'             => 'open',
            'commitSha'         => 'sha',
            'urls'              => ['htmlUrl' => 'htmlUrl', 'pullRequestApiUrl' => 'apiUrl'],
            'submittedAt'       => '2018-01-01T00:01:00+00:00',
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, PullRequestReview::deserialize(json_decode($serialized, true)));
    }
}
