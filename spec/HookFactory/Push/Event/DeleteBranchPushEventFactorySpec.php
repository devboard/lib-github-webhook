<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\HookFactory\Push\Event;

use DevboardLib\GitHubWebhook\CoreFactory\Push\PusherFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\HookFactory\Push\Event\DeleteBranchPushEventFactory;
use PhpSpec\ObjectBehavior;

class DeleteBranchPushEventFactorySpec extends ObjectBehavior
{
    public function let(RepoFactory $repoFactory, PusherFactory $pusherFactory, SenderFactory $senderFactory)
    {
        $this->beConstructedWith($repoFactory, $pusherFactory, $senderFactory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DeleteBranchPushEventFactory::class);
    }

    public function it_can_determine_if_given_data_represents_delete_branch_push_event()
    {
        $data = ['ref' => 'refs/heads/master', 'deleted' => true];
        $this->isSatisfiedBy($data)->shouldReturn(true);
    }
}
