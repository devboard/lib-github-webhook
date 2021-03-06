<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Status;

use DateTime;
use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\Author\AuthorName;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHubWebhook\Core\Status\CommitAuthor;
use DevboardLib\GitHubWebhook\Core\Status\CommitAuthorDetails;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Status\CommitAuthor
 * @group  unit
 */
class CommitAuthorTest extends TestCase
{
    /** @var AuthorName */
    private $name;

    /** @var EmailAddress */
    private $email;

    /** @var DateTime */
    private $createdAt;

    /** @var CommitAuthorDetails|null */
    private $details;

    /** @var CommitAuthor */
    private $sut;

    public function setUp(): void
    {
        $this->name      = new AuthorName('Octo Cat');
        $this->email     = new EmailAddress('octocat@example.com');
        $this->createdAt = new DateTime('2018-01-09T13:29:20+00:00');
        $this->details   = new CommitAuthorDetails(
            new AccountId(1),
            new AccountLogin('value'),
            AccountType::USER(),
            new AccountAvatarUrl('avatarUrl'),
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
        );
        $this->sut = new CommitAuthor($this->name, $this->email, $this->createdAt, $this->details);
    }

    public function testGetName(): void
    {
        self::assertSame($this->name, $this->sut->getName());
    }

    public function testGetEmail(): void
    {
        self::assertSame($this->email, $this->sut->getEmail());
    }

    public function testGetCreatedAt(): void
    {
        self::assertSame($this->createdAt, $this->sut->getCreatedAt());
    }

    public function testGetDetails(): void
    {
        self::assertSame($this->details, $this->sut->getDetails());
    }

    public function testHasDetails(): void
    {
        self::assertTrue($this->sut->hasDetails());
    }

    public function testSerialize(): void
    {
        $expected = [
            'name'      => 'Octo Cat',
            'email'     => 'octocat@example.com',
            'createdAt' => '2018-01-09T13:29:20+00:00',
            'details'   => [
                'userId'            => 1,
                'login'             => 'value',
                'type'              => 'User',
                'avatarUrl'         => 'avatarUrl',
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
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, CommitAuthor::deserialize(json_decode($serialized, true)));
    }
}
