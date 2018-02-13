<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\HookFactory\Push\Event;

use DevboardLib\GitHubWebhook\CoreFactory\Push\CommitFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Push\PusherFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\UpdateTagPushEventFactory;
use PhpSpec\ObjectBehavior;

class UpdateTagPushEventFactorySpec extends ObjectBehavior
{
    public function let(
        CommitFactory $commitFactory,
        RepoFactory $repoFactory,
        PusherFactory $pusherFactory,
        SenderFactory $senderFactory
    ) {
        $this->beConstructedWith($commitFactory, $repoFactory, $pusherFactory, $senderFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(UpdateTagPushEventFactory::class);
    }

    public function it_can_determine_if_given_data_represents_update_tag_push_event()
    {
        $data = ['ref' => 'refs/tags/0.1.0', 'created' => false, 'deleted' => false];
        $this->isSatisfiedBy($data)->shouldReturn(true);
    }
}
