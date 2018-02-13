<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\HookFactory\Installation;

use DevboardLib\GitHubWebhook\CoreFactory\Installation\InstallationFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\HookFactory\Installation\InstallationEventFactory;
use PhpSpec\ObjectBehavior;

class InstallationEventFactorySpec extends ObjectBehavior
{
    public function let(InstallationFactory $installationFactory, SenderFactory $senderFactory)
    {
        $this->beConstructedWith($installationFactory, $senderFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(InstallationEventFactory::class);
    }
}
