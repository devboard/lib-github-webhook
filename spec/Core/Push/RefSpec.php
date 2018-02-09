<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\GitHubWebhook\Core\Push\Ref;
use Exception;
use PhpSpec\ObjectBehavior;

class RefSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('refs/heads/master');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Ref::class);
    }

    public function it_throws_exception_if_no_heads_or_tags_in_middle()
    {
        $this->shouldThrow(Exception::class)
            ->during('__construct', ['refs/xx/master']);
    }

    public function it_will_expose_value()
    {
        $this->getValue()->shouldReturn('refs/heads/master');
    }

    public function it_should_be_castable_to_string()
    {
        $this->__toString()->shouldReturn('refs/heads/master');
    }

    public function it_knows_it_is_branch()
    {
        $this->beConstructedWith('refs/heads/master');
        $this->isBranchReference()->shouldReturn(true);
    }

    public function it_knows_it_is_not_tag()
    {
        $this->beConstructedWith('refs/heads/master');
        $this->isTagReference()->shouldReturn(false);
    }

    public function it_can_return_branch_name_as_a_reference_name()
    {
        $this->beConstructedWith('refs/heads/master');
        $this->getReferenceName()->shouldReturn('master');
    }

    public function it_can_be_tag()
    {
        $this->beConstructedWith('refs/tags/0.1.0');

        $this->getValue()->shouldReturn('refs/tags/0.1.0');
        $this->__toString()->shouldReturn('refs/tags/0.1.0');
    }

    public function it_can_return_tag_name_as_a_reference_name()
    {
        $this->beConstructedWith('refs/tags/0.1.0');
        $this->getReferenceName()->shouldReturn('0.1.0');
    }

    public function it_knows_it_is_tag()
    {
        $this->beConstructedWith('refs/tags/0.1.0');
        $this->isTagReference()->shouldReturn(true);
    }

    public function it_knows_it_is_not_branch()
    {
        $this->beConstructedWith('refs/tags/0.1.0');
        $this->isBranchReference()->shouldReturn(false);
    }
}
