<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\Label;

use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use DevboardLib\Generix\GravatarId;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\GitHubLabel;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHub\Label\LabelApiUrl;
use DevboardLib\GitHub\Label\LabelColor;
use DevboardLib\GitHub\Label\LabelId;
use DevboardLib\GitHub\Label\LabelName;
use DevboardLib\GitHub\User\UserApiUrl;
use DevboardLib\GitHub\User\UserAvatarUrl;
use DevboardLib\GitHub\User\UserHtmlUrl;
use DevboardLib\GitHub\User\UserId;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\Label\CreatedLabelEvent;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @covers \DevboardLib\GitHubWebhook\Hook\Label\CreatedLabelEvent
 * @group  todo
 */
class CreatedLabelEventTest extends TestCase
{
    /** @var GitHubLabel */
    private $label;

    /** @var Repo */
    private $repo;

    /** @var InstallationId */
    private $installationId;

    /** @var Sender */
    private $sender;

    /** @var CreatedLabelEvent */
    private $sut;

    public function setUp()
    {
        $this->label = new GitHubLabel(
            new LabelId(1), new LabelName('value'), new LabelColor('color'), true, new LabelApiUrl('apiUrl')
        );
        $this->repo           = RepoSample::octocatLinguist();
        $this->installationId = new InstallationId(1);
        $this->sender         = new Sender(
            new UserId(1),
            new UserLogin('value'),
            AccountType::USER(),
            new UserAvatarUrl('avatarUrl'),
            new GravatarId('id'),
            new UserHtmlUrl('htmlUrl'),
            new UserApiUrl('apiUrl'),
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
        $this->sut = new CreatedLabelEvent($this->label, $this->repo, $this->installationId, $this->sender);
    }

    public function testGetLabel()
    {
        self::assertSame($this->label, $this->sut->getLabel());
    }

    public function testGetRepo()
    {
        self::assertSame($this->repo, $this->sut->getRepo());
    }

    public function testGetInstallationId()
    {
        self::assertSame($this->installationId, $this->sut->getInstallationId());
    }

    public function testGetSender()
    {
        self::assertSame($this->sender, $this->sut->getSender());
    }

    public function testSerialize()
    {
        $expected = [
            'label'          => ['id' => 1, 'name' => 'value', 'color' => 'color', 'default' => true, 'apiUrl' => 'apiUrl'],
            'repo'           => RepoSample::serialized('octocatLinguist'),
            'installationId' => 1,
            'sender'         => [
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
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, CreatedLabelEvent::deserialize(json_decode($serialized, true)));
    }
}
