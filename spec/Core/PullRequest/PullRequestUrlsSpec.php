<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHub\PullRequest\PullRequestApiUrl;
use DevboardLib\GitHub\PullRequest\PullRequestHtmlUrl;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestUrls;
use PhpSpec\ObjectBehavior;

class PullRequestUrlsSpec extends ObjectBehavior
{
    public function let(PullRequestApiUrl $apiUrl, PullRequestHtmlUrl $htmlUrl)
    {
        $this->beConstructedWith(
            $apiUrl,
            $htmlUrl,
            $commentsUrl = 'commentsUrl',
            $commitsUrl = 'commitsUrl',
            $diffUrl = 'diffUrl',
            $issueUrl = 'issueUrl',
            $patchUrl = 'patchUrl',
            $reviewCommentUrl = 'reviewCommentUrl',
            $reviewCommentsUrl = 'reviewCommentsUrl',
            $statusesUrl = 'statusesUrl'
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PullRequestUrls::class);
    }

    public function it_exposes_api_url(PullRequestApiUrl $apiUrl)
    {
        $this->getApiUrl()->shouldReturn($apiUrl);
    }

    public function it_exposes_html_url(PullRequestHtmlUrl $htmlUrl)
    {
        $this->getHtmlUrl()->shouldReturn($htmlUrl);
    }

    public function it_exposes_comments_url()
    {
        $this->getCommentsUrl()->shouldReturn('commentsUrl');
    }

    public function it_exposes_commits_url()
    {
        $this->getCommitsUrl()->shouldReturn('commitsUrl');
    }

    public function it_exposes_diff_url()
    {
        $this->getDiffUrl()->shouldReturn('diffUrl');
    }

    public function it_exposes_issue_url()
    {
        $this->getIssueUrl()->shouldReturn('issueUrl');
    }

    public function it_exposes_patch_url()
    {
        $this->getPatchUrl()->shouldReturn('patchUrl');
    }

    public function it_exposes_review_comment_url()
    {
        $this->getReviewCommentUrl()->shouldReturn('reviewCommentUrl');
    }

    public function it_exposes_review_comments_url()
    {
        $this->getReviewCommentsUrl()->shouldReturn('reviewCommentsUrl');
    }

    public function it_exposes_statuses_url()
    {
        $this->getStatusesUrl()->shouldReturn('statusesUrl');
    }

    public function it_can_be_serialized(PullRequestApiUrl $apiUrl, PullRequestHtmlUrl $htmlUrl)
    {
        $apiUrl->serialize()->shouldBeCalled()->willReturn('apiUrl');
        $htmlUrl->serialize()->shouldBeCalled()->willReturn('htmlUrl');
        $this->serialize()->shouldReturn(
            [
                'apiUrl'            => 'apiUrl',
                'htmlUrl'           => 'htmlUrl',
                'commentsUrl'       => 'commentsUrl',
                'commitsUrl'        => 'commitsUrl',
                'diffUrl'           => 'diffUrl',
                'issueUrl'          => 'issueUrl',
                'patchUrl'          => 'patchUrl',
                'reviewCommentUrl'  => 'reviewCommentUrl',
                'reviewCommentsUrl' => 'reviewCommentsUrl',
                'statusesUrl'       => 'statusesUrl',
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'apiUrl'            => 'apiUrl',
            'htmlUrl'           => 'htmlUrl',
            'commentsUrl'       => 'commentsUrl',
            'commitsUrl'        => 'commitsUrl',
            'diffUrl'           => 'diffUrl',
            'issueUrl'          => 'issueUrl',
            'patchUrl'          => 'patchUrl',
            'reviewCommentUrl'  => 'reviewCommentUrl',
            'reviewCommentsUrl' => 'reviewCommentsUrl',
            'statusesUrl'       => 'statusesUrl',
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(PullRequestUrls::class);
    }
}
