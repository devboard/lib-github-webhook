<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHubWebhook\CoreFactory\RepoAdditionalDetailsFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoAdditionalUrlsFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoEndpointsFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoOwnerFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoStatsFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoTimestampsFactory;
use PhpSpec\ObjectBehavior;

class RepoFactorySpec extends ObjectBehavior
{
    public function let(
        RepoOwnerFactory $ownerFactory,
        RepoEndpointsFactory $endpointsFactory,
        RepoTimestampsFactory $timestampsFactory,
        RepoStatsFactory $statsFactory,
        RepoAdditionalDetailsFactory $additionalDetailsFactory,
        RepoAdditionalUrlsFactory $additionalUrlsFactory
    ) {
        $this->beConstructedWith(
            $ownerFactory,
            $endpointsFactory,
            $timestampsFactory,
            $statsFactory,
            $additionalDetailsFactory,
            $additionalUrlsFactory
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RepoFactory::class);
    }
}
