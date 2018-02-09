<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\Author\AuthorName;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Push\CommitAuthor;
use PhpSpec\ObjectBehavior;

class CommitAuthorSpec extends ObjectBehavior
{
    public function let(AuthorName $name, EmailAddress $email, UserLogin $username)
    {
        $this->beConstructedWith($name, $email, $username);
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

    public function it_can_be_serialized(AuthorName $name, EmailAddress $email, UserLogin $username)
    {
        $name->serialize()->shouldBeCalled()->willReturn('Octo Cat');
        $email->serialize()->shouldBeCalled()->willReturn('octocat@example.com');
        $username->serialize()->shouldBeCalled()->willReturn('octocat');
        $this->serialize()->shouldReturn(
            ['name' => 'Octo Cat', 'email' => 'octocat@example.com', 'username' => 'octocat']
        );
    }

    public function it_can_be_deserialized()
    {
        $input = ['name' => 'Octo Cat', 'email' => 'octocat@example.com', 'username' => 'octocat'];

        $this->deserialize($input)->shouldReturnAnInstanceOf(CommitAuthor::class);
    }
}
