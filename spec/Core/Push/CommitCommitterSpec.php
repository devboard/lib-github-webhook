<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\Committer\CommitterName;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Push\CommitCommitter;
use DevboardLib\GitHubWebhook\Core\Push\CommitCommitterDetails;
use PhpSpec\ObjectBehavior;

class CommitCommitterSpec extends ObjectBehavior
{
    public function let(CommitterName $name, EmailAddress $email, UserLogin $username, CommitCommitterDetails $details)
    {
        $this->beConstructedWith($name, $email, $username, $details);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CommitCommitter::class);
        $this->shouldImplement(CommitCommitter::class);
    }

    public function it_exposes_name(CommitterName $name)
    {
        $this->getName()->shouldReturn($name);
    }

    public function it_exposes_email(EmailAddress $email)
    {
        $this->getEmail()->shouldReturn($email);
    }

    public function it_exposes_username(UserLogin $username)
    {
        $this->getUsername()->shouldReturn($username);
    }

    public function it_exposes_details(CommitCommitterDetails $details)
    {
        $this->getDetails()->shouldReturn($details);
    }

    public function it_has_username()
    {
        $this->hasUsername()->shouldReturn(true);
    }

    public function it_has_details()
    {
        $this->hasDetails()->shouldReturn(true);
    }

    public function it_can_be_serialized(
        CommitterName $name, EmailAddress $email, UserLogin $username, CommitCommitterDetails $details
    ) {
        $name->serialize()->shouldBeCalled()->willReturn('Octo Cat');
        $email->serialize()->shouldBeCalled()->willReturn('octocat@example.com');
        $username->serialize()->shouldBeCalled()->willReturn('octocat');
        $details->serialize()->shouldBeCalled()->willReturn(
            [
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
            ]
        );
        $this->serialize()->shouldReturn(
            [
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
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
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

        $this->deserialize($input)->shouldReturnAnInstanceOf(CommitCommitter::class);
    }
}
