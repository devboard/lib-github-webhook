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

    public function it_can_be_created_from_strings()
    {
        $this->create('devboard-test', 'nobody@example.com')->shouldReturnAnInstanceOf(Pusher::class);
    }

    public function it_should_expose_user_login_as_object(UserLogin $login)
    {
        $this->getLogin()->shouldReturn($login);
    }

    public function it_should_expose_repository_name_as_object(EmailAddress $emailAddress)
    {
        $this->getEmailAddress()->shouldReturn($emailAddress);
    }
}
