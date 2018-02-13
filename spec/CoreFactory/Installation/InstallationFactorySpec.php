<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\CoreFactory\Installation;

use DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationAccountFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationFactory;
use PhpSpec\ObjectBehavior;

class InstallationFactorySpec extends ObjectBehavior
{
    public function let(InstallationAccountFactory $installationAccountFactory)
    {
        $this->beConstructedWith($installationAccountFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(InstallationFactory::class);
    }
}
