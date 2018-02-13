<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHubWebhook\CoreFactory\RepoEndpointsFactory;
use PhpSpec\ObjectBehavior;

class RepoEndpointsFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(RepoEndpointsFactory::class);
    }
}
