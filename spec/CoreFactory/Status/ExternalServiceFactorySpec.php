<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\CoreFactory\Status;

use DevboardLib\GitHubWebhook\CoreFactory\Status\ExternalServiceFactory;
use PhpSpec\ObjectBehavior;

class ExternalServiceFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(ExternalServiceFactory::class);
    }
}
