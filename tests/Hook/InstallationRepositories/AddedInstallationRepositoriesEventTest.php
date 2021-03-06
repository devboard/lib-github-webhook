<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Hook\InstallationRepositories;

use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\Application\ApplicationId;
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
use DevboardLib\GitHubWebhook\Core\Installation\InstallationDetails;
use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReference;
use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReferenceCollection;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\InstallationRepositories\AddedInstallationRepositoriesEvent;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @covers \DevboardLib\GitHubWebhook\Hook\InstallationRepositories\AddedInstallationRepositoriesEvent
 * @group  unit
 */
class AddedInstallationRepositoriesEventTest extends TestCase
{
    /** @var InstallationDetails */
    private $installation;

    /** @var RepositoryReferenceCollection */
    private $reposAdded;

    /** @var Sender */
    private $sender;

    /** @var AddedInstallationRepositoriesEvent */
    private $sut;

    public function setUp(): void
    {
        $this->installation = new InstallationDetails(
            new InstallationId(1),
            new InstallationAccount(
                new AccountId(1),
                new AccountLogin('value'),
                AccountType::USER(),
                new AccountAvatarUrl('avatarUrl'),
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
        $this->reposAdded = new RepositoryReferenceCollection(
            [new RepositoryReference(new RepoId(1), new RepoFullName(new AccountLogin('value'), new RepoName('name')))]
        );
        $this->sender = SenderSample::octocat();
        $this->sut    = new AddedInstallationRepositoriesEvent($this->installation, $this->reposAdded, $this->sender);
    }

    public function testGetInstallation(): void
    {
        self::assertSame($this->installation, $this->sut->getInstallation());
    }

    public function testGetReposAdded(): void
    {
        self::assertSame($this->reposAdded, $this->sut->getReposAdded());
    }

    public function testGetSender(): void
    {
        self::assertSame($this->sender, $this->sut->getSender());
    }

    public function testSerialize(): void
    {
        $expected = [
            'installation' => [
                'installationId'      => 1,
                'installationAccount' => [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
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
            'reposAdded' => [['id' => 1, 'fullName' => ['owner' => 'value', 'repoName' => 'name']]],
            'sender'     => SenderSample::serialized('octocat'),
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, AddedInstallationRepositoriesEvent::deserialize(json_decode($serialized, true)));
    }
}
