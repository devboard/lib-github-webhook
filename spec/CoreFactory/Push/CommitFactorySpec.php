<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\CoreFactory\Push;

use DevboardLib\GitHubWebhook\CoreFactory\Push\CommitFactory;
use PhpSpec\ObjectBehavior;

class CommitFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(CommitFactory::class);
    }
}
