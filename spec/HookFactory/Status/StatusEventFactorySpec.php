<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\HookFactory\Status;

use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Status\CommitFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Status\GitHubStatusFactory;
use DevboardLib\GitHubWebhook\HookFactory\Status\StatusEventFactory;
use PhpSpec\ObjectBehavior;

class StatusEventFactorySpec extends ObjectBehavior
{
    public function let(
        GitHubStatusFactory $statusFactory,
        CommitFactory $commitFactory,
        RepoFactory $repoFactory,
        SenderFactory $senderFactory
    ) {
        $this->beConstructedWith($statusFactory, $commitFactory, $repoFactory, $senderFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(StatusEventFactory::class);
    }
}
