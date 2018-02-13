<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHubWebhook\CoreFactory\RepoAdditionalDetailsFactory;
use PhpSpec\ObjectBehavior;

class RepoAdditionalDetailsFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(RepoAdditionalDetailsFactory::class);
    }
}
