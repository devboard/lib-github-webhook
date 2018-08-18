<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\Committer\CommitterName;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Push\CommitCommitter;
use DevboardLib\GitHubWebhook\Core\Push\CommitCommitterDetails;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @covers \DevboardLib\GitHubWebhook\Core\Push\CommitCommitter
 * @group  todo
 */
class CommitCommitterTest extends TestCase
{
    /** @var CommitterName */
    private $name;

    /** @var EmailAddress */
    private $email;

    /** @var UserLogin|null */
    private $username;

    /** @var CommitCommitterDetails|null */
    private $details;

    /** @var CommitCommitter */
    private $sut;

    public function setUp()
    {
        $this->name     = new CommitterName('Octo Cat');
        $this->email    = new EmailAddress('octocat@example.com');
        $this->username = new UserLogin('octocat');
        $this->details  = new CommitCommitterDetails(
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
        $this->sut = new CommitCommitter($this->name, $this->email, $this->username, $this->details);
    }

    public function testGetName()
    {
        self::assertSame($this->name, $this->sut->getName());
    }

    public function testGetEmail()
    {
        self::assertSame($this->email, $this->sut->getEmail());
    }

    public function testGetUsername()
    {
        self::assertSame($this->username, $this->sut->getUsername());
    }

    public function testGetDetails()
    {
        self::assertSame($this->details, $this->sut->getDetails());
    }

    public function testHasUsername()
    {
        self::assertTrue($this->sut->hasUsername());
    }

    public function testHasDetails()
    {
        self::assertTrue($this->sut->hasDetails());
    }

    public function testSerialize()
    {
        $expected = [
            'name'     => 'Octo Cat',
            'email'    => 'octocat@example.com',
            'username' => 'octocat',
            'details'  => [
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

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, CommitCommitter::deserialize(json_decode($serialized, true)));
    }
}
