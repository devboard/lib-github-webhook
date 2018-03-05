<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Push\Pusher;
use PhpSpec\ObjectBehavior;

class PusherSpec extends ObjectBehavior
{
    public function let(UserLogin $login, EmailAddress $emailAddress)
    {
        $this->beConstructedWith($login, $emailAddress);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Pusher::class);
    }

    public function it_exposes_login(UserLogin $login)
    {
        $this->getLogin()->shouldReturn($login);
    }

    public function it_exposes_email_address(EmailAddress $emailAddress)
    {
        $this->getEmailAddress()->shouldReturn($emailAddress);
    }

    public function it_has_email_address()
    {
        $this->hasEmailAddress()->shouldReturn(true);
    }

    public function it_can_be_serialized(UserLogin $login, EmailAddress $emailAddress)
    {
        $login->serialize()->shouldBeCalled()->willReturn('Octo Cat');
        $emailAddress->serialize()->shouldBeCalled()->willReturn('octocat@example.com');
        $this->serialize()->shouldReturn(['login' => 'Octo Cat', 'emailAddress' => 'octocat@example.com']);
    }

    public function it_can_be_deserialized()
    {
        $input = ['login' => 'Octo Cat', 'emailAddress' => 'octocat@example.com'];

        $this->deserialize($input)->shouldReturnAnInstanceOf(Pusher::class);
    }
}
