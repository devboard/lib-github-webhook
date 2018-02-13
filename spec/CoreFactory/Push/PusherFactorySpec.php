<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\CoreFactory\Push;

use DevboardLib\GitHubWebhook\CoreFactory\Push\PusherFactory;
use PhpSpec\ObjectBehavior;

class PusherFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(PusherFactory::class);
    }
}
