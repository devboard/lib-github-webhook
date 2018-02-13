<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHubWebhook\CoreFactory\RepoAdditionalUrlsFactory;
use PhpSpec\ObjectBehavior;

class RepoAdditionalUrlsFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(RepoAdditionalUrlsFactory::class);
    }
}
