<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\IssueComment;

use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueAssignee;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueAssigneeCollection;
use PhpSpec\ObjectBehavior;

class IssueAssigneeCollectionSpec extends ObjectBehavior
{
    public function let(IssueAssignee $issueAssignee)
    {
        $this->beConstructedWith($elements = [$issueAssignee]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(IssueAssigneeCollection::class);
    }

    public function it_exposes_elements(IssueAssignee $issueAssignee)
    {
        $this->toArray()->shouldReturn([$issueAssignee]);
    }

    public function it_exposes_number_of_elements_in_collection()
    {
        $this->count()->shouldReturn(1);
    }

    public function it_supports_add_new_element(IssueAssignee $anotherIssueAssignee)
    {
        $this->add($anotherIssueAssignee);
        $this->count()->shouldReturn(2);
    }

    public function it_knows_if_element_is_in_collection(IssueAssignee $issueAssignee, AccountId $accountId)
    {
        $issueAssignee->getUserId()->shouldBeCalled()->willReturn($accountId);
        $this->has($accountId)->shouldReturn(true);
    }

    public function it_can_return_element_from_collection_by_given_id(
        IssueAssignee $issueAssignee, AccountId $accountId
    ) {
        $issueAssignee->getUserId()->shouldBeCalled()->willReturn($accountId);
        $this->get($accountId)->shouldReturn($issueAssignee);
    }
}
