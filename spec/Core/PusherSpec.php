<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\GitHubWebhook\Core\Pusher;
use PhpSpec\ObjectBehavior;

class PusherSpec extends ObjectBehavior
{
    public function let(EmailAddress $email)
    {
        $this->beConstructedWith($name = 'Octo Cat', $email);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Pusher::class);
    }

    public function it_exposes_name()
    {
        $this->getName()->shouldReturn('Octo Cat');
    }

    public function it_exposes_email(EmailAddress $email)
    {
        $this->getEmail()->shouldReturn($email);
    }

    public function it_can_be_serialized(EmailAddress $email)
    {
        $email->serialize()->shouldBeCalled()->willReturn('octocat@example.com');
        $this->serialize()->shouldReturn(['name' => 'Octo Cat', 'email' => 'octocat@example.com']);
    }

    public function it_can_be_deserialized()
    {
        $input = ['name' => 'Octo Cat', 'email' => 'octocat@example.com'];

        $this->deserialize($input)->shouldReturnAnInstanceOf(Pusher::class);
    }
}
