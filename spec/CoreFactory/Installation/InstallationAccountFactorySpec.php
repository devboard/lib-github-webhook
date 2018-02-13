<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\CoreFactory\Installation;

use DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationAccountFactory;
use PhpSpec\ObjectBehavior;

class InstallationAccountFactorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(InstallationAccountFactory::class);
    }
}
