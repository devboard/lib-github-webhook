<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\Author\AuthorName;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Push\CommitAuthor;
use DevboardLib\GitHubWebhook\Core\Push\CommitAuthorDetails;
use PhpSpec\ObjectBehavior;

class CommitAuthorSpec extends ObjectBehavior
{
    public function let(AuthorName $name, EmailAddress $email, UserLogin $username, CommitAuthorDetails $details)
    {
        $this->beConstructedWith($name, $email, $username, $details);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CommitAuthor::class);
        $this->shouldImplement(CommitAuthor::class);
    }

    public function it_exposes_name(AuthorName $name)
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

    public function it_exposes_details(CommitAuthorDetails $details)
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
        AuthorName $name, EmailAddress $email, UserLogin $username, CommitAuthorDetails $details
    ) {
        $name->serialize()->shouldBeCalled()->willReturn('Octo Cat');
        $email->serialize()->shouldBeCalled()->willReturn('octocat@example.com');
        $username->serialize()->shouldBeCalled()->willReturn('octocat');
        $details->serialize()->shouldBeCalled()->willReturn(
            [
                'userId'            => 1,
                'login'             => 'value',
                'type'              => \Mockery::mock('DevboardLib\GitHub\Account\AccountType'),
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
                    'type'              => \Mockery::mock('DevboardLib\GitHub\Account\AccountType'),
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
                'type'              => \Mockery::mock('DevboardLib\GitHub\Account\AccountType'),
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

        $this->deserialize($input)->shouldReturnAnInstanceOf(CommitAuthor::class);
    }
}
