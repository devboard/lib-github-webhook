<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Status;

use DateTime;
use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\Committer\CommitterName;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHubWebhook\Core\Status\CommitCommitter;
use DevboardLib\GitHubWebhook\Core\Status\CommitCommitterDetails;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Status\CommitCommitter
 * @group  unit
 */
class CommitCommitterTest extends TestCase
{
    /** @var CommitterName */
    private $name;

    /** @var EmailAddress */
    private $email;

    /** @var DateTime */
    private $committedAt;

    /** @var CommitCommitterDetails|null */
    private $details;

    /** @var CommitCommitter */
    private $sut;

    public function setUp(): void
    {
        $this->name        = new CommitterName('Octo Cat');
        $this->email       = new EmailAddress('octocat@example.com');
        $this->committedAt = new DateTime('2018-01-09T13:32:56+00:00');
        $this->details     = new CommitCommitterDetails(
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
        $this->sut = new CommitCommitter($this->name, $this->email, $this->committedAt, $this->details);
    }

    public function testGetName(): void
    {
        self::assertSame($this->name, $this->sut->getName());
    }

    public function testGetEmail(): void
    {
        self::assertSame($this->email, $this->sut->getEmail());
    }

    public function testGetCommittedAt(): void
    {
        self::assertSame($this->committedAt, $this->sut->getCommittedAt());
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
            'name'        => 'Octo Cat',
            'email'       => 'octocat@example.com',
            'committedAt' => '2018-01-09T13:32:56+00:00',
            'details'     => [
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
        self::assertEquals($this->sut, CommitCommitter::deserialize(json_decode($serialized, true)));
    }
}
