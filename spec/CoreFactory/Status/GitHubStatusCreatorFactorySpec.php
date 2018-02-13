<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\CoreFactory\Status;

use DevboardLib\GitHubWebhook\CoreFactory\Status\GitHubStatusCreatorFactory;
use PhpSpec\ObjectBehavior;

class GitHubStatusCreatorFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(GitHubStatusCreatorFactory::class);
    }
}
