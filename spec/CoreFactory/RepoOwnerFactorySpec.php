<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHubWebhook\CoreFactory\RepoOwnerFactory;
use PhpSpec\ObjectBehavior;

class RepoOwnerFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(RepoOwnerFactory::class);
    }
}
