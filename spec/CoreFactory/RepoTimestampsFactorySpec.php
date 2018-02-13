<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHubWebhook\CoreFactory\RepoTimestampsFactory;
use PhpSpec\ObjectBehavior;

class RepoTimestampsFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(RepoTimestampsFactory::class);
    }
}
