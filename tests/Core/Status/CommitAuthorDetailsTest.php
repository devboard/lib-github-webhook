<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Status;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHubWebhook\Core\Status\CommitAuthorDetails;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Status\CommitAuthorDetails
 * @group  unit
 */
class CommitAuthorDetailsTest extends TestCase
{
    /** @var AccountId */
    private $userId;

    /** @var AccountLogin */
    private $login;

    /** @var AccountType */
    private $type;

    /** @var AccountAvatarUrl */
    private $avatarUrl;

    /** @var bool */
    private $siteAdmin;

    /** @var string */
    private $eventsUrl;

    /** @var string */
    private $followersUrl;

    /** @var string */
    private $followingUrl;

    /** @var string */
    private $gistsUrl;

    /** @var string */
    private $organizationsUrl;

    /** @var string */
    private $receivedEventsUrl;

    /** @var string */
    private $reposUrl;

    /** @var string */
    private $starredUrl;

    /** @var string */
    private $subscriptionsUrl;

    /** @var CommitAuthorDetails */
    private $sut;

    public function setUp(): void
    {
        $this->userId            = new AccountId(583231);
        $this->login             = new AccountLogin('octocat');
        $this->type              = new AccountType('User');
        $this->avatarUrl         = new AccountAvatarUrl('https://avatars3.githubusercontent.com/u/583231?v=4');
        $this->siteAdmin         = false;
        $this->eventsUrl         = 'https://api.github.com/users/octocat/events{/privacy}';
        $this->followersUrl      = 'https://api.github.com/users/octocat/followers';
        $this->followingUrl      = 'https://api.github.com/users/octocat/following{/other_user}';
        $this->gistsUrl          = 'https://api.github.com/users/octocat/gists{/gist_id}';
        $this->organizationsUrl  = 'https://api.github.com/users/octocat/orgs';
        $this->receivedEventsUrl = 'https://api.github.com/users/octocat/received_events';
        $this->reposUrl          = 'https://api.github.com/users/octocat/repos';
        $this->starredUrl        = 'https://api.github.com/users/octocat/starred{/owner}{/repo}';
        $this->subscriptionsUrl  = 'https://api.github.com/users/octocat/subscriptions';
        $this->sut               = new CommitAuthorDetails(
            $this->userId,
            $this->login,
            $this->type,
            $this->avatarUrl,
            $this->siteAdmin,
            $this->eventsUrl,
            $this->followersUrl,
            $this->followingUrl,
            $this->gistsUrl,
            $this->organizationsUrl,
            $this->receivedEventsUrl,
            $this->reposUrl,
            $this->starredUrl,
            $this->subscriptionsUrl
        );
    }

    public function testGetUserId(): void
    {
        self::assertSame($this->userId, $this->sut->getUserId());
    }

    public function testGetLogin(): void
    {
        self::assertSame($this->login, $this->sut->getLogin());
    }

    public function testGetType(): void
    {
        self::assertSame($this->type, $this->sut->getType());
    }

    public function testGetAvatarUrl(): void
    {
        self::assertSame($this->avatarUrl, $this->sut->getAvatarUrl());
    }

    public function testIsSiteAdmin(): void
    {
        self::assertSame($this->siteAdmin, $this->sut->isSiteAdmin());
    }

    public function testGetEventsUrl(): void
    {
        self::assertSame($this->eventsUrl, $this->sut->getEventsUrl());
    }

    public function testGetFollowersUrl(): void
    {
        self::assertSame($this->followersUrl, $this->sut->getFollowersUrl());
    }

    public function testGetFollowingUrl(): void
    {
        self::assertSame($this->followingUrl, $this->sut->getFollowingUrl());
    }

    public function testGetGistsUrl(): void
    {
        self::assertSame($this->gistsUrl, $this->sut->getGistsUrl());
    }

    public function testGetOrganizationsUrl(): void
    {
        self::assertSame($this->organizationsUrl, $this->sut->getOrganizationsUrl());
    }

    public function testGetReceivedEventsUrl(): void
    {
        self::assertSame($this->receivedEventsUrl, $this->sut->getReceivedEventsUrl());
    }

    public function testGetReposUrl(): void
    {
        self::assertSame($this->reposUrl, $this->sut->getReposUrl());
    }

    public function testGetStarredUrl(): void
    {
        self::assertSame($this->starredUrl, $this->sut->getStarredUrl());
    }

    public function testGetSubscriptionsUrl(): void
    {
        self::assertSame($this->subscriptionsUrl, $this->sut->getSubscriptionsUrl());
    }

    public function testSerialize(): void
    {
        $expected = [
            'userId'            => 583231,
            'login'             => 'octocat',
            'type'              => 'User',
            'avatarUrl'         => 'https://avatars3.githubusercontent.com/u/583231?v=4',
            'siteAdmin'         => false,
            'eventsUrl'         => 'https://api.github.com/users/octocat/events{/privacy}',
            'followersUrl'      => 'https://api.github.com/users/octocat/followers',
            'followingUrl'      => 'https://api.github.com/users/octocat/following{/other_user}',
            'gistsUrl'          => 'https://api.github.com/users/octocat/gists{/gist_id}',
            'organizationsUrl'  => 'https://api.github.com/users/octocat/orgs',
            'receivedEventsUrl' => 'https://api.github.com/users/octocat/received_events',
            'reposUrl'          => 'https://api.github.com/users/octocat/repos',
            'starredUrl'        => 'https://api.github.com/users/octocat/starred{/owner}{/repo}',
            'subscriptionsUrl'  => 'https://api.github.com/users/octocat/subscriptions',
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, CommitAuthorDetails::deserialize(json_decode($serialized, true)));
    }
}
