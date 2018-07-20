<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\GitHubWebhook\Core\Push\CompareChangesUrl;
use PhpSpec\ObjectBehavior;

class CompareChangesUrlSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith($url = 'url');
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CompareChangesUrl::class);
    }

    public function it_exposes_url()
    {
        $this->getUrl()->shouldReturn('url');
    }

    public function it_exposes_id()
    {
        $this->getId()->shouldReturn('url');
    }

    public function it_is_castable_to_string()
    {
        $this->asString()->shouldReturn('url');
    }

    public function it_can_be_serialized()
    {
        $this->serialize()->shouldReturn('url');
    }

    public function it_can_be_deserialized()
    {
        $input = 'url';

        $this->deserialize($input)->shouldReturnAnInstanceOf(CompareChangesUrl::class);
    }
}
