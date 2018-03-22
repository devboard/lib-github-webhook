<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\PullRequestReview;

use DevboardLib\GitHub\PullRequest\PullRequestApiUrl;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewHtmlUrl;
use DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReviewUrls;
use PhpSpec\ObjectBehavior;

class PullRequestReviewUrlsSpec extends ObjectBehavior
{
    public function let(PullRequestReviewHtmlUrl $htmlUrl, PullRequestApiUrl $pullRequestApiUrl)
    {
        $this->beConstructedWith($htmlUrl, $pullRequestApiUrl);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PullRequestReviewUrls::class);
    }

    public function it_exposes_html_url(PullRequestReviewHtmlUrl $htmlUrl)
    {
        $this->getHtmlUrl()->shouldReturn($htmlUrl);
    }

    public function it_exposes_value(PullRequestApiUrl $pullRequestApiUrl)
    {
        $this->getValue()->shouldReturn($pullRequestApiUrl);
    }

    public function it_exposes_pull_request_api_url(PullRequestApiUrl $pullRequestApiUrl)
    {
        $this->getPullRequestApiUrl()->shouldReturn($pullRequestApiUrl);
    }

    public function it_can_be_serialized(PullRequestReviewHtmlUrl $htmlUrl, PullRequestApiUrl $pullRequestApiUrl)
    {
        $htmlUrl->serialize()->shouldBeCalled()->willReturn('htmlUrl');
        $pullRequestApiUrl->serialize()->shouldBeCalled()->willReturn('apiUrl');
        $this->serialize()->shouldReturn(['htmlUrl' => 'htmlUrl', 'pullRequestApiUrl' => 'apiUrl']);
    }

    public function it_can_be_deserialized()
    {
        $input = ['htmlUrl' => 'htmlUrl', 'pullRequestApiUrl' => 'apiUrl'];

        $this->deserialize($input)->shouldReturnAnInstanceOf(PullRequestReviewUrls::class);
    }
}
