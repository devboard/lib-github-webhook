<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\PullRequestReview;

use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAuthorSample;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewAuthor;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewBody;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewId;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewState;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewSubmittedAt;
use DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReview;
use DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReviewUrls;
use PhpSpec\ObjectBehavior;

class PullRequestReviewSpec extends ObjectBehavior
{
    public function let(
        PullRequestReviewId $id,
        PullRequestReviewBody $body,
        PullRequestReviewAuthor $author,
        PullRequestReviewState $state,
        CommitSha $commitSha,
        PullRequestReviewUrls $urls,
        PullRequestReviewSubmittedAt $submittedAt
    ) {
        $this->beConstructedWith($id, $body, $author, $state, $commitSha, $urls, $submittedAt);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PullRequestReview::class);
    }

    public function it_exposes_id(PullRequestReviewId $id)
    {
        $this->getId()->shouldReturn($id);
    }

    public function it_exposes_body(PullRequestReviewBody $body)
    {
        $this->getBody()->shouldReturn($body);
    }

    public function it_exposes_author(PullRequestReviewAuthor $author)
    {
        $this->getAuthor()->shouldReturn($author);
    }

    public function it_exposes_state(PullRequestReviewState $state)
    {
        $this->getState()->shouldReturn($state);
    }

    public function it_exposes_commit_sha(CommitSha $commitSha)
    {
        $this->getCommitSha()->shouldReturn($commitSha);
    }

    public function it_exposes_urls(PullRequestReviewUrls $urls)
    {
        $this->getUrls()->shouldReturn($urls);
    }

    public function it_exposes_submitted_at(PullRequestReviewSubmittedAt $submittedAt)
    {
        $this->getSubmittedAt()->shouldReturn($submittedAt);
    }

    public function it_can_be_serialized(
        PullRequestReviewId $id,
        PullRequestReviewBody $body,
        PullRequestReviewAuthor $author,
        PullRequestReviewState $state,
        CommitSha $commitSha,
        PullRequestReviewUrls $urls,
        PullRequestReviewSubmittedAt $submittedAt
    ) {
        $id->serialize()->shouldBeCalled()->willReturn(1);
        $body->serialize()->shouldBeCalled()->willReturn('value');
        $author->serialize()->shouldBeCalled()->willReturn(PullRequestAuthorSample::serialized('octocat'));
        $state->serialize()->shouldBeCalled()->willReturn('approved');
        $commitSha->serialize()->shouldBeCalled()->willReturn('sha');
        $urls->serialize()->shouldBeCalled()->willReturn(['htmlUrl' => 'htmlUrl', 'pullRequestApiUrl' => 'apiUrl']);
        $submittedAt->serialize()->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $this->serialize()->shouldReturn(
            [
                'id'          => 1,
                'body'        => 'value',
                'author'      => PullRequestAuthorSample::serialized('octocat'),
                'state'       => 'approved',
                'commitSha'   => 'sha',
                'urls'        => ['htmlUrl' => 'htmlUrl', 'pullRequestApiUrl' => 'apiUrl'],
                'submittedAt' => '2018-01-01T00:01:00+00:00',
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'id'          => 1,
            'body'        => 'value',
            'author'      => PullRequestAuthorSample::serialized('octocat'),
            'state'       => 'approved',
            'commitSha'   => 'sha',
            'urls'        => ['htmlUrl' => 'htmlUrl', 'pullRequestApiUrl' => 'apiUrl'],
            'submittedAt' => '2018-01-01T00:01:00+00:00',
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(PullRequestReview::class);
    }
}
