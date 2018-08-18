<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\IssueComment;

use DevboardLib\GitHub\Issue\IssueId;
use DevboardLib\GitHub\IssueComment\IssueCommentBody;
use DevboardLib\GitHub\IssueComment\IssueCommentCreatedAt;
use DevboardLib\GitHub\IssueComment\IssueCommentId;
use DevboardLib\GitHub\IssueComment\IssueCommentUpdatedAt;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueCommentAuthor;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueCommentDetails;
use PhpSpec\ObjectBehavior;

class IssueCommentDetailsSpec extends ObjectBehavior
{
    public function let(
        IssueCommentId $id,
        IssueId $issueId,
        IssueCommentBody $body,
        IssueCommentAuthor $author,
        IssueCommentCreatedAt $createdAt,
        IssueCommentUpdatedAt $updatedAt
    ) {
        $this->beConstructedWith($id, $issueId, $body, $author, $createdAt, $updatedAt);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(IssueCommentDetails::class);
    }

    public function it_exposes_id(IssueCommentId $id)
    {
        $this->getId()->shouldReturn($id);
    }

    public function it_exposes_issue_id(IssueId $issueId)
    {
        $this->getIssueId()->shouldReturn($issueId);
    }

    public function it_exposes_body(IssueCommentBody $body)
    {
        $this->getBody()->shouldReturn($body);
    }

    public function it_exposes_author(IssueCommentAuthor $author)
    {
        $this->getAuthor()->shouldReturn($author);
    }

    public function it_exposes_created_at(IssueCommentCreatedAt $createdAt)
    {
        $this->getCreatedAt()->shouldReturn($createdAt);
    }

    public function it_exposes_updated_at(IssueCommentUpdatedAt $updatedAt)
    {
        $this->getUpdatedAt()->shouldReturn($updatedAt);
    }

    public function it_can_be_serialized(
        IssueCommentId $id,
        IssueId $issueId,
        IssueCommentBody $body,
        IssueCommentAuthor $author,
        IssueCommentCreatedAt $createdAt,
        IssueCommentUpdatedAt $updatedAt
    ) {
        $id->serialize()->shouldBeCalled()->willReturn(1);
        $issueId->serialize()->shouldBeCalled()->willReturn(1);
        $body->serialize()->shouldBeCalled()->willReturn('value');
        $author->serialize()->shouldBeCalled()->willReturn(
            ['userId' => 1, 'login' => 'value', 'type' => 'User', 'avatarUrl' => 'avatarUrl', 'siteAdmin' => true]
        );
        $createdAt->serialize()->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $updatedAt->serialize()->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $this->serialize()->shouldReturn(
            [
                'id'      => 1,
                'issueId' => 1,
                'body'    => 'value',
                'author'  => [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'id'      => 1,
            'issueId' => 1,
            'body'    => 'value',
            'author'  => [
                'userId'    => 1,
                'login'     => 'value',
                'type'      => 'User',
                'avatarUrl' => 'avatarUrl',
                'siteAdmin' => true,
            ],
            'createdAt' => '2018-01-01T00:01:00+00:00',
            'updatedAt' => '2018-01-01T00:01:00+00:00',
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(IssueCommentDetails::class);
    }
}
