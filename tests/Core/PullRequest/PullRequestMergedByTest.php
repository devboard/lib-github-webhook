<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\Generix\GravatarId;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\User\UserApiUrl;
use DevboardLib\GitHub\User\UserAvatarUrl;
use DevboardLib\GitHub\User\UserHtmlUrl;
use DevboardLib\GitHub\User\UserId;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestMergedBy;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestMergedBy
 * @group  unit
 */
class PullRequestMergedByTest extends TestCase
{
    /** @var UserId */
    private $userId;

    /** @var UserLogin */
    private $login;

    /** @var AccountType */
    private $type;

    /** @var UserAvatarUrl */
    private $avatarUrl;

    /** @var GravatarId|null */
    private $gravatarId;

    /** @var UserHtmlUrl */
    private $htmlUrl;

    /** @var UserApiUrl */
    private $apiUrl;

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

    /** @var PullRequestMergedBy */
    private $sut;

    public function setUp()
    {
        $this->userId            = new UserId(6752317);
        $this->login             = new UserLogin('baxterthehacker');
        $this->type              = new AccountType('User');
        $this->avatarUrl         = new UserAvatarUrl('https://avatars.githubusercontent.com/u/6752317?v=3');
        $this->gravatarId        = new GravatarId('id');
        $this->htmlUrl           = new UserHtmlUrl('https://github.com/baxterthehacker');
        $this->apiUrl            = new UserApiUrl('https://api.github.com/users/baxterthehacker');
        $this->siteAdmin         = false;
        $this->eventsUrl         = 'https://api.github.com/users/baxterthehacker/events{/privacy}';
        $this->followersUrl      = 'https://api.github.com/users/baxterthehacker/followers';
        $this->followingUrl      = 'https://api.github.com/users/baxterthehacker/following{/other_user}';
        $this->gistsUrl          = 'https://api.github.com/users/baxterthehacker/gists{/gist_id}';
        $this->organizationsUrl  = 'https://api.github.com/users/baxterthehacker/orgs';
        $this->receivedEventsUrl = 'https://api.github.com/users/baxterthehacker/received_events';
        $this->reposUrl          = 'https://api.github.com/users/baxterthehacker/repos';
        $this->starredUrl        = 'https://api.github.com/users/baxterthehacker/starred{/owner}{/repo}';
        $this->subscriptionsUrl  = 'https://api.github.com/users/baxterthehacker/subscriptions';
        $this->sut               = new PullRequestMergedBy(
            $this->userId,
            $this->login,
            $this->type,
            $this->avatarUrl,
            $this->gravatarId,
            $this->htmlUrl,
            $this->apiUrl,
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

    public function testGetUserId()
    {
        self::assertSame($this->userId, $this->sut->getUserId());
    }

    public function testGetLogin()
    {
        self::assertSame($this->login, $this->sut->getLogin());
    }

    public function testGetType()
    {
        self::assertSame($this->type, $this->sut->getType());
    }

    public function testGetAvatarUrl()
    {
        self::assertSame($this->avatarUrl, $this->sut->getAvatarUrl());
    }

    public function testGetGravatarId()
    {
        self::assertSame($this->gravatarId, $this->sut->getGravatarId());
    }

    public function testGetHtmlUrl()
    {
        self::assertSame($this->htmlUrl, $this->sut->getHtmlUrl());
    }

    public function testGetApiUrl()
    {
        self::assertSame($this->apiUrl, $this->sut->getApiUrl());
    }

    public function testIsSiteAdmin()
    {
        self::assertSame($this->siteAdmin, $this->sut->isSiteAdmin());
    }

    public function testGetEventsUrl()
    {
        self::assertSame($this->eventsUrl, $this->sut->getEventsUrl());
    }

    public function testGetFollowersUrl()
    {
        self::assertSame($this->followersUrl, $this->sut->getFollowersUrl());
    }

    public function testGetFollowingUrl()
    {
        self::assertSame($this->followingUrl, $this->sut->getFollowingUrl());
    }

    public function testGetGistsUrl()
    {
        self::assertSame($this->gistsUrl, $this->sut->getGistsUrl());
    }

    public function testGetOrganizationsUrl()
    {
        self::assertSame($this->organizationsUrl, $this->sut->getOrganizationsUrl());
    }

    public function testGetReceivedEventsUrl()
    {
        self::assertSame($this->receivedEventsUrl, $this->sut->getReceivedEventsUrl());
    }

    public function testGetReposUrl()
    {
        self::assertSame($this->reposUrl, $this->sut->getReposUrl());
    }

    public function testGetStarredUrl()
    {
        self::assertSame($this->starredUrl, $this->sut->getStarredUrl());
    }

    public function testGetSubscriptionsUrl()
    {
        self::assertSame($this->subscriptionsUrl, $this->sut->getSubscriptionsUrl());
    }

    public function testHasGravatarId()
    {
        self::assertTrue($this->sut->hasGravatarId());
    }

    public function testSerialize()
    {
        $expected = [
            'userId'            => 6752317,
            'login'             => 'baxterthehacker',
            'type'              => 'User',
            'avatarUrl'         => 'https://avatars.githubusercontent.com/u/6752317?v=3',
            'gravatarId'        => 'id',
            'htmlUrl'           => 'https://github.com/baxterthehacker',
            'apiUrl'            => 'https://api.github.com/users/baxterthehacker',
            'siteAdmin'         => false,
            'eventsUrl'         => 'https://api.github.com/users/baxterthehacker/events{/privacy}',
            'followersUrl'      => 'https://api.github.com/users/baxterthehacker/followers',
            'followingUrl'      => 'https://api.github.com/users/baxterthehacker/following{/other_user}',
            'gistsUrl'          => 'https://api.github.com/users/baxterthehacker/gists{/gist_id}',
            'organizationsUrl'  => 'https://api.github.com/users/baxterthehacker/orgs',
            'receivedEventsUrl' => 'https://api.github.com/users/baxterthehacker/received_events',
            'reposUrl'          => 'https://api.github.com/users/baxterthehacker/repos',
            'starredUrl'        => 'https://api.github.com/users/baxterthehacker/starred{/owner}{/repo}',
            'subscriptionsUrl'  => 'https://api.github.com/users/baxterthehacker/subscriptions',
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, PullRequestMergedBy::deserialize(json_decode($serialized, true)));
    }
}
