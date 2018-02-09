<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHubWebhook\Core\Push\Commit;
use DevboardLib\GitHubWebhook\Core\Push\CommitCollection;
use PhpSpec\ObjectBehavior;

class CommitCollectionSpec extends ObjectBehavior
{
    public function let(Commit $commit)
    {
        $this->beConstructedWith($elements = [$commit]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CommitCollection::class);
    }

    public function it_exposes_elements(Commit $commit)
    {
        $this->toArray()->shouldReturn([$commit]);
    }

    public function it_exposes_number_of_elements_in_collection()
    {
        $this->count()->shouldReturn(1);
    }

    public function it_supports_add_new_element(Commit $anotherCommit)
    {
        $this->add($anotherCommit);
        $this->count()->shouldReturn(2);
    }

    public function it_knows_if_element_is_in_collection(Commit $commit, CommitSha $commitSha)
    {
        $commit->getSha()->shouldBeCalled()->willReturn($commitSha);
        $this->has($commitSha)->shouldReturn(true);
    }

    public function it_can_return_element_from_collection_by_given_id(Commit $commit, CommitSha $commitSha)
    {
        $commit->getSha()->shouldBeCalled()->willReturn($commitSha);
        $this->get($commitSha)->shouldReturn($commit);
    }
}
