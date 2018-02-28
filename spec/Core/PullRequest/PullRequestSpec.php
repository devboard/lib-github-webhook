<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\PullRequest;

use Data\DevboardLib\GitHubWebhook\Core\Label\LabelSample;
use Data\DevboardLib\GitHubWebhook\Core\MilestoneSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAssigneeSample;
use Data\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestAuthorSample;
use DevboardLib\GitHub\GitHubLabelCollection;
use DevboardLib\GitHub\GitHubMilestone;
use DevboardLib\GitHub\PullRequest\PullRequestApiUrl;
use DevboardLib\GitHub\PullRequest\PullRequestAssignee;
use DevboardLib\GitHub\PullRequest\PullRequestAssigneeCollection;
use DevboardLib\GitHub\PullRequest\PullRequestAuthor;
use DevboardLib\GitHub\PullRequest\PullRequestBody;
use DevboardLib\GitHub\PullRequest\PullRequestClosedAt;
use DevboardLib\GitHub\PullRequest\PullRequestCreatedAt;
use DevboardLib\GitHub\PullRequest\PullRequestHtmlUrl;
use DevboardLib\GitHub\PullRequest\PullRequestId;
use DevboardLib\GitHub\PullRequest\PullRequestNumber;
use DevboardLib\GitHub\PullRequest\PullRequestState;
use DevboardLib\GitHub\PullRequest\PullRequestTitle;
use DevboardLib\GitHub\PullRequest\PullRequestUpdatedAt;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use PhpSpec\ObjectBehavior;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 */
class PullRequestSpec extends ObjectBehavior
{
    public function let(
        PullRequestId $id,
        PullRequestNumber $number,
        PullRequestTitle $title,
        PullRequestBody $body,
        PullRequestState $state,
        PullRequestAuthor $author,
        PullRequestApiUrl $apiUrl,
        PullRequestHtmlUrl $htmlUrl,
        PullRequestAssignee $assignee,
        PullRequestAssigneeCollection $assignees,
        GitHubLabelCollection $labels,
        GitHubMilestone $milestone,
        PullRequestClosedAt $closedAt,
        PullRequestCreatedAt $createdAt,
        PullRequestUpdatedAt $updatedAt
    ) {
        $this->beConstructedWith(
            $id,
            $number,
            $title,
            $body,
            $state,
            $author,
            $apiUrl,
            $htmlUrl,
            $assignee,
            $assignees,
            $labels,
            $milestone,
            $closedAt,
            $createdAt,
            $updatedAt
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PullRequest::class);
    }

    public function it_exposes_id(PullRequestId $id)
    {
        $this->getId()->shouldReturn($id);
    }

    public function it_exposes_number(PullRequestNumber $number)
    {
        $this->getNumber()->shouldReturn($number);
    }

    public function it_exposes_title(PullRequestTitle $title)
    {
        $this->getTitle()->shouldReturn($title);
    }

    public function it_exposes_body(PullRequestBody $body)
    {
        $this->getBody()->shouldReturn($body);
    }

    public function it_exposes_state(PullRequestState $state)
    {
        $this->getState()->shouldReturn($state);
    }

    public function it_exposes_author(PullRequestAuthor $author)
    {
        $this->getAuthor()->shouldReturn($author);
    }

    public function it_exposes_api_url(PullRequestApiUrl $apiUrl)
    {
        $this->getApiUrl()->shouldReturn($apiUrl);
    }

    public function it_exposes_html_url(PullRequestHtmlUrl $htmlUrl)
    {
        $this->getHtmlUrl()->shouldReturn($htmlUrl);
    }

    public function it_exposes_assignee(PullRequestAssignee $assignee)
    {
        $this->getAssignee()->shouldReturn($assignee);
    }

    public function it_exposes_assignees(PullRequestAssigneeCollection $assignees)
    {
        $this->getAssignees()->shouldReturn($assignees);
    }

    public function it_exposes_labels(GitHubLabelCollection $labels)
    {
        $this->getLabels()->shouldReturn($labels);
    }

    public function it_exposes_milestone(GitHubMilestone $milestone)
    {
        $this->getMilestone()->shouldReturn($milestone);
    }

    public function it_exposes_closed_at(PullRequestClosedAt $closedAt)
    {
        $this->getClosedAt()->shouldReturn($closedAt);
    }

    public function it_exposes_created_at(PullRequestCreatedAt $createdAt)
    {
        $this->getCreatedAt()->shouldReturn($createdAt);
    }

    public function it_exposes_updated_at(PullRequestUpdatedAt $updatedAt)
    {
        $this->getUpdatedAt()->shouldReturn($updatedAt);
    }

    public function it_has_assignee()
    {
        $this->hasAssignee()->shouldReturn(true);
    }

    public function it_has_milestone()
    {
        $this->hasMilestone()->shouldReturn(true);
    }

    public function it_has_closed_at()
    {
        $this->hasClosedAt()->shouldReturn(true);
    }

    public function it_can_be_serialized(
        PullRequestId $id,
        PullRequestNumber $number,
        PullRequestTitle $title,
        PullRequestBody $body,
        PullRequestState $state,
        PullRequestAuthor $author,
        PullRequestApiUrl $apiUrl,
        PullRequestHtmlUrl $htmlUrl,
        PullRequestAssignee $assignee,
        PullRequestAssigneeCollection $assignees,
        GitHubLabelCollection $labels,
        GitHubMilestone $milestone,
        PullRequestClosedAt $closedAt,
        PullRequestCreatedAt $createdAt,
        PullRequestUpdatedAt $updatedAt
    ) {
        $id->serialize()->shouldBeCalled()->willReturn(1);
        $number->serialize()->shouldBeCalled()->willReturn(1);
        $title->serialize()->shouldBeCalled()->willReturn('value');
        $body->serialize()->shouldBeCalled()->willReturn('value');
        $state->serialize()->shouldBeCalled()->willReturn('open');
        $author->serialize()->shouldBeCalled()->willReturn(PullRequestAuthorSample::serialized('octocat'));
        $apiUrl->serialize()->shouldBeCalled()->willReturn('apiUrl');
        $htmlUrl->serialize()->shouldBeCalled()->willReturn('htmlUrl');
        $assignee->serialize()->shouldBeCalled()->willReturn(PullRequestAssigneeSample::serialized('octocat'));
        $assignees->serialize()->shouldBeCalled()->willReturn([PullRequestAssigneeSample::serialized('octocat')]);
        $labels->serialize()->shouldBeCalled()->willReturn([LabelSample::serialized('red')]);
        $milestone->serialize()->shouldBeCalled()->willReturn(MilestoneSample::serialized('sprint1'));
        $closedAt->serialize()->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $createdAt->serialize()->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $updatedAt->serialize()->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $this->serialize()->shouldReturn(
            [
                'id'        => 1,
                'number'    => 1,
                'title'     => 'value',
                'body'      => 'value',
                'state'     => 'open',
                'author'    => PullRequestAuthorSample::serialized('octocat'),
                'apiUrl'    => 'apiUrl',
                'htmlUrl'   => 'htmlUrl',
                'assignee'  => PullRequestAssigneeSample::serialized('octocat'),
                'assignees' => [PullRequestAssigneeSample::serialized('octocat')],
                'labels'    => [LabelSample::serialized('red')],
                'milestone' => MilestoneSample::serialized('sprint1'),
                'closedAt'  => '2018-01-01T00:01:00+00:00',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'id'        => 1,
            'number'    => 1,
            'title'     => 'value',
            'body'      => 'value',
            'state'     => 'open',
            'author'    => PullRequestAssigneeSample::serialized('octocat'),
            'apiUrl'    => 'apiUrl',
            'htmlUrl'   => 'htmlUrl',
            'assignee'  => PullRequestAssigneeSample::serialized('octocat'),
            'assignees' => [PullRequestAssigneeSample::serialized('octocat')],
            'labels'    => [LabelSample::serialized('red')],
            'milestone' => MilestoneSample::serialized('sprint1'),
            'closedAt'  => '2018-01-01T00:01:00+00:00',
            'createdAt' => '2018-01-01T00:01:00+00:00',
            'updatedAt' => '2018-01-01T00:01:00+00:00',
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(PullRequest::class);
    }
}
