<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use PhpSpec\ObjectBehavior;

class SenderFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(SenderFactory::class);
    }
}
