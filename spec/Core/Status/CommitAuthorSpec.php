<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Status;

use DateTime;
use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\Author\AuthorName;
use DevboardLib\GitHubWebhook\Core\Status\CommitAuthor;
use DevboardLib\GitHubWebhook\Core\Status\CommitAuthorDetails;
use PhpSpec\ObjectBehavior;

class CommitAuthorSpec extends ObjectBehavior
{
    public function let(AuthorName $name, EmailAddress $email, DateTime $createdAt, CommitAuthorDetails $details)
    {
        $this->beConstructedWith($name, $email, $createdAt, $details);
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

    public function it_exposes_created_at(DateTime $createdAt)
    {
        $this->getCreatedAt()->shouldReturn($createdAt);
    }

    public function it_exposes_details(CommitAuthorDetails $details)
    {
        $this->getDetails()->shouldReturn($details);
    }

    public function it_has_details()
    {
        $this->hasDetails()->shouldReturn(true);
    }

    public function it_can_be_serialized(
        AuthorName $name, EmailAddress $email, DateTime $createdAt, CommitAuthorDetails $details
    ) {
        $name->serialize()->shouldBeCalled()->willReturn('Octo Cat');
        $email->serialize()->shouldBeCalled()->willReturn('octocat@example.com');
        $createdAt->format('c')->shouldBeCalled()->willReturn('2018-01-09T13:29:20Z');
        $details->serialize()->shouldBeCalled()->willReturn(
            [
                'userId'            => 1,
                'login'             => 'value',
                'type'              => 'User',
                'avatarUrl'         => 'avatarUrl',
                'gravatarId'        => 'id',
                'htmlUrl'           => 'htmlUrl',
                'apiUrl'            => 'apiUrl',
                'siteAdmin'         => true,
                'name'              => 'name',
                'email'             => 'email',
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
                'name'      => 'Octo Cat',
                'email'     => 'octocat@example.com',
                'createdAt' => '2018-01-09T13:29:20Z',
                'details'   => [
                    'userId'            => 1,
                    'login'             => 'value',
                    'type'              => 'User',
                    'avatarUrl'         => 'avatarUrl',
                    'gravatarId'        => 'id',
                    'htmlUrl'           => 'htmlUrl',
                    'apiUrl'            => 'apiUrl',
                    'siteAdmin'         => true,
                    'name'              => 'name',
                    'email'             => 'email',
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
            'name'      => 'Octo Cat',
            'email'     => 'octocat@example.com',
            'createdAt' => '2018-01-09T13:29:20Z',
            'details'   => [
                'userId'            => 1,
                'login'             => 'value',
                'type'              => 'User',
                'avatarUrl'         => 'avatarUrl',
                'gravatarId'        => 'id',
                'htmlUrl'           => 'htmlUrl',
                'apiUrl'            => 'apiUrl',
                'siteAdmin'         => true,
                'name'              => 'name',
                'email'             => 'email',
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
