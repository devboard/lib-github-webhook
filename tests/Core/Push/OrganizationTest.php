<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHubWebhook\Core\Push\Organization;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Push\Organization
 * @group  unit
 */
class OrganizationTest extends TestCase
{
    /** @var AccountId */
    private $id;

    /** @var AccountLogin */
    private $login;

    /** @var AccountAvatarUrl */
    private $avatarUrl;

    /** @var string */
    private $description;

    /** @var string */
    private $reposUrl;

    /** @var string */
    private $issuesUrl;

    /** @var string */
    private $eventsUrl;

    /** @var string */
    private $hooksUrl;

    /** @var string */
    private $membersUrl;

    /** @var string */
    private $publicMembersUrl;

    /** @var Organization */
    private $sut;

    public function setUp()
    {
        $this->id               = new AccountId(3259285);
        $this->login            = new AccountLogin('zgphp');
        $this->avatarUrl        = new AccountAvatarUrl('https://avatars3.githubusercontent.com/u/3259285?v=4');
        $this->description      = 'Zagreb PHP Meetup';
        $this->reposUrl         = 'https://api.github.com/orgs/zgphp/repos';
        $this->issuesUrl        = 'https://api.github.com/orgs/zgphp/issues';
        $this->eventsUrl        = 'https://api.github.com/orgs/zgphp/events';
        $this->hooksUrl         = 'https://api.github.com/orgs/zgphp/hooks';
        $this->membersUrl       = 'https://api.github.com/orgs/zgphp/members{/member}';
        $this->publicMembersUrl = 'https://api.github.com/orgs/zgphp/public_members{/member}';
        $this->sut              = new Organization(
            $this->id,
            $this->login,
            $this->avatarUrl,
            $this->description,
            $this->reposUrl,
            $this->issuesUrl,
            $this->eventsUrl,
            $this->hooksUrl,
            $this->membersUrl,
            $this->publicMembersUrl
        );
    }

    public function testGetId()
    {
        self::assertSame($this->id, $this->sut->getId());
    }

    public function testGetLogin()
    {
        self::assertSame($this->login, $this->sut->getLogin());
    }

    public function testGetAvatarUrl()
    {
        self::assertSame($this->avatarUrl, $this->sut->getAvatarUrl());
    }

    public function testGetDescription()
    {
        self::assertSame($this->description, $this->sut->getDescription());
    }

    public function testGetReposUrl()
    {
        self::assertSame($this->reposUrl, $this->sut->getReposUrl());
    }

    public function testGetIssuesUrl()
    {
        self::assertSame($this->issuesUrl, $this->sut->getIssuesUrl());
    }

    public function testGetEventsUrl()
    {
        self::assertSame($this->eventsUrl, $this->sut->getEventsUrl());
    }

    public function testGetHooksUrl()
    {
        self::assertSame($this->hooksUrl, $this->sut->getHooksUrl());
    }

    public function testGetMembersUrl()
    {
        self::assertSame($this->membersUrl, $this->sut->getMembersUrl());
    }

    public function testGetPublicMembersUrl()
    {
        self::assertSame($this->publicMembersUrl, $this->sut->getPublicMembersUrl());
    }

    public function testSerialize()
    {
        $expected = [
            'id'               => 3259285,
            'login'            => 'zgphp',
            'avatarUrl'        => 'https://avatars3.githubusercontent.com/u/3259285?v=4',
            'description'      => 'Zagreb PHP Meetup',
            'reposUrl'         => 'https://api.github.com/orgs/zgphp/repos',
            'issuesUrl'        => 'https://api.github.com/orgs/zgphp/issues',
            'eventsUrl'        => 'https://api.github.com/orgs/zgphp/events',
            'hooksUrl'         => 'https://api.github.com/orgs/zgphp/hooks',
            'membersUrl'       => 'https://api.github.com/orgs/zgphp/members{/member}',
            'publicMembersUrl' => 'https://api.github.com/orgs/zgphp/public_members{/member}',
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, Organization::deserialize(json_decode($serialized, true)));
    }
}
