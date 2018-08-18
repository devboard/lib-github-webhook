<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\IssueComment;

use DevboardLib\GitHub\GitHubLabelCollection;
use DevboardLib\GitHub\GitHubMilestone;
use DevboardLib\GitHub\Issue\IssueBody;
use DevboardLib\GitHub\Issue\IssueClosedAt;
use DevboardLib\GitHub\Issue\IssueCreatedAt;
use DevboardLib\GitHub\Issue\IssueId;
use DevboardLib\GitHub\Issue\IssueNumber;
use DevboardLib\GitHub\Issue\IssueState;
use DevboardLib\GitHub\Issue\IssueTitle;
use DevboardLib\GitHub\Issue\IssueUpdatedAt;
use DevboardLib\GitHub\Milestone\MilestoneState;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueAssigneeCollection;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueAuthor;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueDetails;
use PhpSpec\ObjectBehavior;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 */
class IssueDetailsSpec extends ObjectBehavior
{
    public function let(
        IssueId $id,
        IssueNumber $number,
        IssueTitle $title,
        IssueBody $body,
        IssueState $state,
        IssueAuthor $author,
        IssueAssigneeCollection $assignees,
        GitHubLabelCollection $labels,
        GitHubMilestone $milestone,
        IssueClosedAt $closedAt,
        IssueCreatedAt $createdAt,
        IssueUpdatedAt $updatedAt
    ) {
        $this->beConstructedWith(
            $id,
            $number,
            $title,
            $body,
            $state,
            $author,
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
        $this->shouldHaveType(IssueDetails::class);
    }

    public function it_exposes_id(IssueId $id)
    {
        $this->getId()->shouldReturn($id);
    }

    public function it_exposes_number(IssueNumber $number)
    {
        $this->getNumber()->shouldReturn($number);
    }

    public function it_exposes_title(IssueTitle $title)
    {
        $this->getTitle()->shouldReturn($title);
    }

    public function it_exposes_body(IssueBody $body)
    {
        $this->getBody()->shouldReturn($body);
    }

    public function it_exposes_state(IssueState $state)
    {
        $this->getState()->shouldReturn($state);
    }

    public function it_exposes_author(IssueAuthor $author)
    {
        $this->getAuthor()->shouldReturn($author);
    }

    public function it_exposes_assignees(IssueAssigneeCollection $assignees)
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

    public function it_exposes_closed_at(IssueClosedAt $closedAt)
    {
        $this->getClosedAt()->shouldReturn($closedAt);
    }

    public function it_exposes_created_at(IssueCreatedAt $createdAt)
    {
        $this->getCreatedAt()->shouldReturn($createdAt);
    }

    public function it_exposes_updated_at(IssueUpdatedAt $updatedAt)
    {
        $this->getUpdatedAt()->shouldReturn($updatedAt);
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
        IssueId $id,
        IssueNumber $number,
        IssueTitle $title,
        IssueBody $body,
        IssueState $state,
        IssueAuthor $author,
        IssueAssigneeCollection $assignees,
        GitHubLabelCollection $labels,
        GitHubMilestone $milestone,
        IssueClosedAt $closedAt,
        IssueCreatedAt $createdAt,
        IssueUpdatedAt $updatedAt
    ) {
        $id->serialize()->shouldBeCalled()->willReturn(1);
        $number->serialize()->shouldBeCalled()->willReturn(1);
        $title->serialize()->shouldBeCalled()->willReturn('value');
        $body->serialize()->shouldBeCalled()->willReturn('value');
        $state->serialize()->shouldBeCalled()->willReturn(IssueState::OPEN);
        $author->serialize()->shouldBeCalled()->willReturn(
            ['userId' => 1, 'login' => 'value', 'type' => 'User', 'avatarUrl' => 'avatarUrl', 'siteAdmin' => true]
        );
        $assignees->serialize()->shouldBeCalled()->willReturn(
            [
                [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
            ]
        );
        $labels->serialize()->shouldBeCalled()->willReturn(
            [['id' => 1, 'name' => 'value', 'color' => 'color', 'default' => true]]
        );
        $milestone->serialize()->shouldBeCalled()->willReturn(
            [
                'id'          => 1,
                'title'       => 'value',
                'description' => 'value',
                'dueOn'       => '2018-01-01T00:01:00+00:00',
                'state'       => MilestoneState::OPEN,
                'number'      => 1,
                'creator'     => [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
                'closedAt'  => '2018-01-01T00:01:00+00:00',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ]
        );
        $closedAt->serialize()->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $createdAt->serialize()->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $updatedAt->serialize()->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $this->serialize()->shouldReturn(
            [
                'id'     => 1,
                'number' => 1,
                'title'  => 'value',
                'body'   => 'value',
                'state'  => IssueState::OPEN,
                'author' => [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
                'assignees' => [
                    [
                        'userId'    => 1,
                        'login'     => 'value',
                        'type'      => 'User',
                        'avatarUrl' => 'avatarUrl',
                        'siteAdmin' => true,
                    ],
                ],
                'labels'    => [['id' => 1, 'name' => 'value', 'color' => 'color', 'default' => true]],
                'milestone' => [
                    'id'          => 1,
                    'title'       => 'value',
                    'description' => 'value',
                    'dueOn'       => '2018-01-01T00:01:00+00:00',
                    'state'       => MilestoneState::OPEN,
                    'number'      => 1,
                    'creator'     => [
                        'userId'    => 1,
                        'login'     => 'value',
                        'type'      => 'User',
                        'avatarUrl' => 'avatarUrl',
                        'siteAdmin' => true,
                    ],
                    'closedAt'  => '2018-01-01T00:01:00+00:00',
                    'createdAt' => '2018-01-01T00:01:00+00:00',
                    'updatedAt' => '2018-01-01T00:01:00+00:00',
                ],
                'closedAt'  => '2018-01-01T00:01:00+00:00',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'id'     => 1,
            'number' => 1,
            'title'  => 'value',
            'body'   => 'value',
            'state'  => IssueState::OPEN,
            'author' => [
                'userId'    => 1,
                'login'     => 'value',
                'type'      => 'User',
                'avatarUrl' => 'avatarUrl',
                'siteAdmin' => true,
            ],
            'assignees' => [
                [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
            ],
            'labels'    => [['id' => 1, 'name' => 'value', 'color' => 'color', 'default' => true]],
            'milestone' => [
                'id'          => 1,
                'title'       => 'value',
                'description' => 'value',
                'dueOn'       => '2018-01-01T00:01:00+00:00',
                'state'       => MilestoneState::OPEN,
                'number'      => 1,
                'creator'     => [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
                'closedAt'  => '2018-01-01T00:01:00+00:00',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ],
            'closedAt'  => '2018-01-01T00:01:00+00:00',
            'createdAt' => '2018-01-01T00:01:00+00:00',
            'updatedAt' => '2018-01-01T00:01:00+00:00',
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(IssueDetails::class);
    }
}
