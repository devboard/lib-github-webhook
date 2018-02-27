<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Hook\InstallationRepositories;

use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\GitHubInstallation;
use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReferenceCollection;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\InstallationRepositories\AddedInstallationRepositoriesEvent;
use DevboardLib\GitHubWebhook\Hook\InstallationRepositories\InstallationRepositoriesEvent;
use PhpSpec\ObjectBehavior;

class AddedInstallationRepositoriesEventSpec extends ObjectBehavior
{
    public function let(GitHubInstallation $installation, RepositoryReferenceCollection $reposAdded, Sender $sender)
    {
        $this->beConstructedWith($installation, $reposAdded, $sender);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(AddedInstallationRepositoriesEvent::class);
        $this->shouldImplement(InstallationRepositoriesEvent::class);
    }

    public function it_exposes_installation(GitHubInstallation $installation)
    {
        $this->getInstallation()->shouldReturn($installation);
    }

    public function it_exposes_repos_added(RepositoryReferenceCollection $reposAdded)
    {
        $this->getReposAdded()->shouldReturn($reposAdded);
    }

    public function it_exposes_sender(Sender $sender)
    {
        $this->getSender()->shouldReturn($sender);
    }

    public function it_can_be_serialized(
        GitHubInstallation $installation, RepositoryReferenceCollection $reposAdded, Sender $sender
    ) {
        $installation->serialize()->shouldBeCalled()->willReturn(
            [
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
            ]
        );
        $reposAdded->serialize()->shouldBeCalled()->willReturn(
            [['id' => 1, 'fullName' => ['owner' => 'value', 'repoName' => 'name']]]
        );
        $sender->serialize()->shouldBeCalled()->willReturn(SenderSample::serialized('octocat'));
        $this->serialize()->shouldReturn(
            [
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
                'reposAdded' => [['id' => 1, 'fullName' => ['owner' => 'value', 'repoName' => 'name']]],
                'sender'     => SenderSample::serialized('octocat'),
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
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
            'reposAdded' => [['id' => 1, 'fullName' => ['owner' => 'value', 'repoName' => 'name']]],
            'sender'     => SenderSample::serialized('octocat'),
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(AddedInstallationRepositoriesEvent::class);
    }
}
