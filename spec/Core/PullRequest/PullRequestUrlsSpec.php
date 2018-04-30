<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestUrls;
use PhpSpec\ObjectBehavior;

class PullRequestUrlsSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(
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

    public function it_can_be_serialized()
    {
        $this->serialize()->shouldReturn(
            [
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
