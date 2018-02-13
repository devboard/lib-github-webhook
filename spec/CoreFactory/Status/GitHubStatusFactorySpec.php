<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\CoreFactory\Status;

use DevboardLib\GitHubWebhook\CoreFactory\Status\ExternalServiceFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Status\GitHubStatusCreatorFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Status\GitHubStatusFactory;
use PhpSpec\ObjectBehavior;

class GitHubStatusFactorySpec extends ObjectBehavior
{
    public function let(
        GitHubStatusCreatorFactory $statusCreatorFactory, ExternalServiceFactory $externalServiceFactory
    ) {
        $this->beConstructedWith($statusCreatorFactory, $externalServiceFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GitHubStatusFactory::class);
    }
}
