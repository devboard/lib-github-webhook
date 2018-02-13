<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Status;

use DateTime;
use DevboardLib\Generix\EmailAddress;
use DevboardLib\Generix\GravatarId;
use DevboardLib\Git\Commit\Author\AuthorName;
use DevboardLib\Git\Commit\CommitDate;
use DevboardLib\Git\Commit\CommitMessage;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\Git\Commit\Committer\CommitterName;
use DevboardLib\GitHub\Account\AccountApiUrl;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountHtmlUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\Commit\CommitApiUrl;
use DevboardLib\GitHub\Commit\CommitHtmlUrl;
use DevboardLib\GitHub\Commit\CommitParent;
use DevboardLib\GitHub\Commit\CommitParent\ParentApiUrl;
use DevboardLib\GitHub\Commit\CommitParent\ParentHtmlUrl;
use DevboardLib\GitHub\Commit\CommitParentCollection;
use DevboardLib\GitHub\Commit\CommitTree;
use DevboardLib\GitHub\Commit\CommitVerification;
use DevboardLib\GitHub\Commit\Tree\TreeApiUrl;
use DevboardLib\GitHub\Commit\Verification\VerificationPayload;
use DevboardLib\GitHub\Commit\Verification\VerificationReason;
use DevboardLib\GitHub\Commit\Verification\VerificationSignature;
use DevboardLib\GitHub\Commit\Verification\VerificationVerified;
use DevboardLib\GitHubWebhook\Core\Status\Commit;
use DevboardLib\GitHubWebhook\Core\Status\CommitAuthor;
use DevboardLib\GitHubWebhook\Core\Status\CommitAuthorDetails;
use DevboardLib\GitHubWebhook\Core\Status\CommitCommitter;
use DevboardLib\GitHubWebhook\Core\Status\CommitCommitterDetails;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @covers \DevboardLib\GitHubWebhook\Core\Status\Commit
 * @group  unit
 */
class CommitTest extends TestCase
{
    /** @var CommitSha */
    private $sha;

    /** @var CommitMessage */
    private $message;

    /** @var CommitDate */
    private $commitDate;

    /** @var CommitAuthor */
    private $author;

    /** @var CommitCommitter */
    private $committer;

    /** @var CommitTree */
    private $tree;

    /** @var CommitParentCollection */
    private $parents;

    /** @var CommitVerification */
    private $verification;

    /** @var CommitApiUrl */
    private $apiUrl;

    /** @var CommitHtmlUrl */
    private $htmlUrl;

    /** @var string */
    private $commentsUrl;

    /** @var Commit */
    private $sut;

    public function setUp()
    {
        $this->sha        = new CommitSha('sha');
        $this->message    = new CommitMessage('message');
        $this->commitDate = new CommitDate('2018-01-01T00:01:00+00:00');
        $this->author     = new CommitAuthor(
            new AuthorName('name'),
            new EmailAddress('octocat@example.com'),
            new DateTime('2018-01-01T00:01:00+00:00'),
            new CommitAuthorDetails(
                new AccountId(1),
                new AccountLogin('value'),
                AccountType::USER(),
                new AccountAvatarUrl('avatarUrl'),
                new GravatarId('id'),
                new AccountHtmlUrl('htmlUrl'),
                new AccountApiUrl('apiUrl'),
                true,
                'eventsUrl',
                'followersUrl',
                'followingUrl',
                'gistsUrl',
                'organizationsUrl',
                'receivedEventsUrl',
                'reposUrl',
                'starredUrl',
                'subscriptionsUrl'
            )
        );
        $this->committer = new CommitCommitter(
            new CommitterName('name'),
            new EmailAddress('octocat@example.com'),
            new DateTime('2018-01-01T00:01:00+00:00'),
            new CommitCommitterDetails(
                new AccountId(1),
                new AccountLogin('value'),
                AccountType::USER(),
                new AccountAvatarUrl('avatarUrl'),
                new GravatarId('id'),
                new AccountHtmlUrl('htmlUrl'),
                new AccountApiUrl('apiUrl'),
                true,
                'eventsUrl',
                'followersUrl',
                'followingUrl',
                'gistsUrl',
                'organizationsUrl',
                'receivedEventsUrl',
                'reposUrl',
                'starredUrl',
                'subscriptionsUrl'
            )
        );
        $this->tree    = new CommitTree(new CommitSha('sha'), new TreeApiUrl('url'));
        $this->parents = new CommitParentCollection(
            [new CommitParent(new CommitSha('sha'), new ParentApiUrl('apiUrl'), new ParentHtmlUrl('htmlUrl'))]
        );
        $this->verification = new CommitVerification(
            new VerificationVerified(true),
            new VerificationReason('reason'),
            new VerificationSignature('signature'),
            new VerificationPayload('payload')
        );
        $this->apiUrl      = new CommitApiUrl('apiUrl');
        $this->htmlUrl     = new CommitHtmlUrl('htmlUrl');
        $this->commentsUrl = 'commentsUrl';
        $this->sut         = new Commit(
            $this->sha,
            $this->message,
            $this->commitDate,
            $this->author,
            $this->committer,
            $this->tree,
            $this->parents,
            $this->verification,
            $this->apiUrl,
            $this->htmlUrl,
            $this->commentsUrl
        );
    }

    public function testGetSha()
    {
        self::assertSame($this->sha, $this->sut->getSha());
    }

    public function testGetMessage()
    {
        self::assertSame($this->message, $this->sut->getMessage());
    }

    public function testGetCommitDate()
    {
        self::assertSame($this->commitDate, $this->sut->getCommitDate());
    }

    public function testGetAuthor()
    {
        self::assertSame($this->author, $this->sut->getAuthor());
    }

    public function testGetCommitter()
    {
        self::assertSame($this->committer, $this->sut->getCommitter());
    }

    public function testGetTree()
    {
        self::assertSame($this->tree, $this->sut->getTree());
    }

    public function testGetParents()
    {
        self::assertSame($this->parents, $this->sut->getParents());
    }

    public function testGetVerification()
    {
        self::assertSame($this->verification, $this->sut->getVerification());
    }

    public function testGetApiUrl()
    {
        self::assertSame($this->apiUrl, $this->sut->getApiUrl());
    }

    public function testGetHtmlUrl()
    {
        self::assertSame($this->htmlUrl, $this->sut->getHtmlUrl());
    }

    public function testGetCommentsUrl()
    {
        self::assertSame($this->commentsUrl, $this->sut->getCommentsUrl());
    }

    public function testSerialize()
    {
        $expected = [
            'sha'        => 'sha',
            'message'    => 'message',
            'commitDate' => '2018-01-01T00:01:00+00:00',
            'author'     => [
                'name'      => 'name',
                'email'     => 'octocat@example.com',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'details'   => [
                    'userId'            => 1,
                    'login'             => 'value',
                    'type'              => 'User',
                    'avatarUrl'         => 'avatarUrl',
                    'gravatarId'        => 'id',
                    'htmlUrl'           => 'htmlUrl',
                    'apiUrl'            => 'apiUrl',
                    'siteAdmin'         => true,
                    'eventsUrl'         => 'eventsUrl',
                    'followersUrl'      => 'followersUrl',
                    'followingUrl'      => 'followingUrl',
                    'gistsUrl'          => 'gistsUrl',
                    'organizationsUrl'  => 'organizationsUrl',
                    'receivedEventsUrl' => 'receivedEventsUrl',
                    'reposUrl'          => 'reposUrl',
                    'starredUrl'        => 'starredUrl',
                    'subscriptionsUrl'  => 'subscriptionsUrl',
                ],
            ],
            'committer' => [
                'name'        => 'name',
                'email'       => 'octocat@example.com',
                'committedAt' => '2018-01-01T00:01:00+00:00',
                'details'     => [
                    'userId'            => 1,
                    'login'             => 'value',
                    'type'              => 'User',
                    'avatarUrl'         => 'avatarUrl',
                    'gravatarId'        => 'id',
                    'htmlUrl'           => 'htmlUrl',
                    'apiUrl'            => 'apiUrl',
                    'siteAdmin'         => true,
                    'eventsUrl'         => 'eventsUrl',
                    'followersUrl'      => 'followersUrl',
                    'followingUrl'      => 'followingUrl',
                    'gistsUrl'          => 'gistsUrl',
                    'organizationsUrl'  => 'organizationsUrl',
                    'receivedEventsUrl' => 'receivedEventsUrl',
                    'reposUrl'          => 'reposUrl',
                    'starredUrl'        => 'starredUrl',
                    'subscriptionsUrl'  => 'subscriptionsUrl',
                ],
            ],
            'tree'         => ['sha' => 'sha', 'apiUrl' => 'url'],
            'parents'      => [['sha' => 'sha', 'apiUrl' => 'apiUrl', 'htmlUrl' => 'htmlUrl']],
            'verification' => [
                'verified'  => true,
                'reason'    => 'reason',
                'signature' => 'signature',
                'payload'   => 'payload',
            ],
            'apiUrl'      => 'apiUrl',
            'htmlUrl'     => 'htmlUrl',
            'commentsUrl' => 'commentsUrl',
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, Commit::deserialize(json_decode($serialized, true)));
    }
}
