<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Hook\Installation;

use DevboardLib\GitHub\GitHubInstallation;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\Installation\CreatedInstallationEvent;
use DevboardLib\GitHubWebhook\Hook\Installation\InstallationEvent;
use PhpSpec\ObjectBehavior;

class CreatedInstallationEventSpec extends ObjectBehavior
{
    public function let(GitHubInstallation $installation, Sender $sender)
    {
        $this->beConstructedWith($installation, $sender);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CreatedInstallationEvent::class);
        $this->shouldImplement(InstallationEvent::class);
    }

    public function it_exposes_installation(GitHubInstallation $installation)
    {
        $this->getInstallation()->shouldReturn($installation);
    }

    public function it_exposes_sender(Sender $sender)
    {
        $this->getSender()->shouldReturn($sender);
    }

    public function it_can_be_serialized(GitHubInstallation $installation, Sender $sender)
    {
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
        $sender->serialize()->shouldBeCalled()->willReturn(
            [
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
            ]
        );
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
                'sender' => [
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
            'sender' => [
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

        $this->deserialize($input)->shouldReturnAnInstanceOf(CreatedInstallationEvent::class);
    }
}
