<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Hook\Installation;

use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\GitHubInstallation;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\GitHubHookEvent;
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
        $this->shouldImplement(GitHubHookEvent::class);
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
            ]
        );
        $sender->serialize()->shouldBeCalled()->willReturn(SenderSample::serialized('octocat'));
        $this->serialize()->shouldReturn(
            [
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
                'sender' => SenderSample::serialized('octocat'),
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
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
            'sender' => SenderSample::serialized('octocat'),
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(CreatedInstallationEvent::class);
    }
}
