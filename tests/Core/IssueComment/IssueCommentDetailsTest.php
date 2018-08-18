<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\IssueComment;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\Issue\IssueId;
use DevboardLib\GitHub\IssueComment\IssueCommentBody;
use DevboardLib\GitHub\IssueComment\IssueCommentCreatedAt;
use DevboardLib\GitHub\IssueComment\IssueCommentId;
use DevboardLib\GitHub\IssueComment\IssueCommentUpdatedAt;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueCommentAuthor;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueCommentDetails;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @covers \DevboardLib\GitHubWebhook\Core\IssueComment\IssueCommentDetails
 * @group  todo
 */
class IssueCommentDetailsTest extends TestCase
{
    /** @var IssueCommentId */
    private $id;

    /** @var IssueId */
    private $issueId;

    /** @var IssueCommentBody */
    private $body;

    /** @var IssueCommentAuthor */
    private $author;

    /** @var IssueCommentCreatedAt */
    private $createdAt;

    /** @var IssueCommentUpdatedAt */
    private $updatedAt;

    /** @var IssueCommentDetails */
    private $sut;

    public function setUp()
    {
        $this->id      = new IssueCommentId(1);
        $this->issueId = new IssueId(1);
        $this->body    = new IssueCommentBody('value');
        $this->author  = new IssueCommentAuthor(
            new AccountId(1),
            new AccountLogin('value'),
            AccountType::USER(),
            new AccountAvatarUrl('avatarUrl'),
            true
        );
        $this->createdAt = new IssueCommentCreatedAt('2018-01-01T00:01:00+00:00');
        $this->updatedAt = new IssueCommentUpdatedAt('2018-01-01T00:01:00+00:00');
        $this->sut       = new IssueCommentDetails(
            $this->id, $this->issueId, $this->body, $this->author, $this->createdAt, $this->updatedAt
        );
    }

    public function testGetId()
    {
        self::assertSame($this->id, $this->sut->getId());
    }

    public function testGetIssueId()
    {
        self::assertSame($this->issueId, $this->sut->getIssueId());
    }

    public function testGetBody()
    {
        self::assertSame($this->body, $this->sut->getBody());
    }

    public function testGetAuthor()
    {
        self::assertSame($this->author, $this->sut->getAuthor());
    }

    public function testGetCreatedAt()
    {
        self::assertSame($this->createdAt, $this->sut->getCreatedAt());
    }

    public function testGetUpdatedAt()
    {
        self::assertSame($this->updatedAt, $this->sut->getUpdatedAt());
    }

    public function testSerialize()
    {
        $expected = [
            'id'      => 1,
            'issueId' => 1,
            'body'    => 'value',
            'author'  => [
                'userId'    => 1,
                'login'     => 'value',
                'type'      => 'User',
                'avatarUrl' => 'avatarUrl',
                'siteAdmin' => true,
            ],
            'createdAt' => '2018-01-01T00:01:00+00:00',
            'updatedAt' => '2018-01-01T00:01:00+00:00',
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, IssueCommentDetails::deserialize(json_decode($serialized, true)));
    }
}
