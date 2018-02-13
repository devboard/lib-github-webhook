<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Status;

use DevboardLib\Git\Branch\BranchName;
use DevboardLib\GitHubWebhook\Core\Status\BranchNameCollection;
use PhpSpec\ObjectBehavior;

class BranchNameCollectionSpec extends ObjectBehavior
{
    public function let(BranchName $branchName)
    {
        $this->beConstructedWith($elements = [$branchName]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(BranchNameCollection::class);
    }

    public function it_exposes_elements(BranchName $branchName)
    {
        $this->toArray()->shouldReturn([$branchName]);
    }

    public function it_exposes_number_of_elements_in_collection()
    {
        $this->count()->shouldReturn(1);
    }

    public function it_supports_add_new_element(BranchName $anotherBranchName)
    {
        $this->add($anotherBranchName);
        $this->count()->shouldReturn(2);
    }

    public function it_knows_if_element_is_in_collection(BranchName $branchName)
    {
        $branchName->getValue()->shouldBeCalled()->willReturn('master');
        $this->has('master')->shouldReturn(true);
    }

    public function it_can_return_element_from_collection_by_given_id(BranchName $branchName)
    {
        $branchName->getValue()->shouldBeCalled()->willReturn('master');
        $this->get('master')->shouldReturn($branchName);
    }
}
