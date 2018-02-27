<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\InstallationRepositories;

use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\Generix\GravatarId;
use DevboardLib\GitHub\Account\AccountApiUrl;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountHtmlUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\Application\ApplicationId;
use DevboardLib\GitHub\GitHubInstallation;
use DevboardLib\GitHub\Installation\InstallationAccessTokenUrl;
use DevboardLib\GitHub\Installation\InstallationAccount;
use DevboardLib\GitHub\Installation\InstallationCreatedAt;
use DevboardLib\GitHub\Installation\InstallationEvents;
use DevboardLib\GitHub\Installation\InstallationHtmlUrl;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHub\Installation\InstallationPermissions;
use DevboardLib\GitHub\Installation\InstallationRepositoriesUrl;
use DevboardLib\GitHub\Installation\InstallationRepositorySelection\InstallationRepositoryAll;
use DevboardLib\GitHub\Installation\InstallationUpdatedAt;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHub\Repo\RepoName;
use DevboardLib\GitHub\User\UserId;
use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReference;
use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReferenceCollection;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\InstallationRepositories\RemovedInstallationRepositoriesEvent;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @covers \DevboardLib\GitHubWebhook\Hook\InstallationRepositories\RemovedInstallationRepositoriesEvent
 * @group  unit
 */
class RemovedInstallationRepositoriesEventTest extends TestCase
{
    /** @var GitHubInstallation */
    private $installation;

    /** @var RepositoryReferenceCollection */
    private $reposRemoved;

    /** @var Sender */
    private $sender;

    /** @var RemovedInstallationRepositoriesEvent */
    private $sut;

    public function setUp()
    {
        $this->installation = new GitHubInstallation(
            new InstallationId(1),
            new InstallationAccount(
                new AccountId(1),
                new AccountLogin('value'),
                AccountType::USER(),
                new AccountAvatarUrl('avatarUrl'),
                new GravatarId('id'),
                new AccountHtmlUrl('htmlUrl'),
                new AccountApiUrl('apiUrl'),
                true
            ),
            new ApplicationId(1),
            new InstallationRepositoryAll(),
            new InstallationPermissions(['data']),
            new InstallationEvents(['data']),
            new InstallationAccessTokenUrl('accessTokenUrl'),
            new InstallationRepositoriesUrl('installationRepositoriesUrl'),
            new InstallationHtmlUrl('installationHtmlUrl'),
            new InstallationCreatedAt('2018-01-01T00:01:00+00:00'),
            new InstallationUpdatedAt('2018-01-01T00:01:00+00:00')
        );
        $this->reposRemoved = new RepositoryReferenceCollection(
            [new RepositoryReference(new RepoId(1), new RepoFullName(new AccountLogin('value'), new RepoName('name')))]
        );
        $this->sender = SenderSample::octocat();
        $this->sut    = new RemovedInstallationRepositoriesEvent($this->installation, $this->reposRemoved, $this->sender);
    }

    public function testGetInstallation()
    {
        self::assertSame($this->installation, $this->sut->getInstallation());
    }

    public function testGetReposRemoved()
    {
        self::assertSame($this->reposRemoved, $this->sut->getReposRemoved());
    }

    public function testGetSender()
    {
        self::assertSame($this->sender, $this->sut->getSender());
    }

    public function testSerialize()
    {
        $expected = [
            'installation' => [
                'installationId'      => 1,
                'installationAccount' => [
                    'userId'     => 1,
                    'login'      => 'value',
                    'type'       => 'User',
                    'avatarUrl'  => 'avatarUrl',
                    'gravatarId' => 'id',
                    'htmlUrl'    => 'htmlUrl',
                    'apiUrl'     => 'apiUrl',
                    'siteAdmin'  => true,
                ],
                'applicationId'       => 1,
                'repositorySelection' => 'all',
                'permissions'         => ['data'],
                'events'              => ['data'],
                'accessTokenUrl'      => 'accessTokenUrl',
                'repositoriesUrl'     => 'installationRepositoriesUrl',
                'htmlUrl'             => 'installationHtmlUrl',
                'createdAt'           => '2018-01-01T00:01:00+00:00',
                'updatedAt'           => '2018-01-01T00:01:00+00:00',
            ],
            'reposRemoved' => [['id' => 1, 'fullName' => ['owner' => 'value', 'repoName' => 'name']]],
            'sender'       => SenderSample::serialized('octocat'),
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals(
            $this->sut, RemovedInstallationRepositoriesEvent::deserialize(json_decode($serialized, true))
        );
    }
}
