<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\IssueComment;

use DevboardLib\GitHub\Issue\IssueId;
use DevboardLib\GitHub\IssueComment\IssueCommentBody;
use DevboardLib\GitHub\IssueComment\IssueCommentCreatedAt;
use DevboardLib\GitHub\IssueComment\IssueCommentId;
use DevboardLib\GitHub\IssueComment\IssueCommentUpdatedAt;
use DevboardLib\GitHubWebhook\Core\IssueComment\IssueCommentDetails;

/**
 * @see GitHubIssueCommentFactorySpec
 * @see GitHubIssueCommentFactoryTest
 */
class GitHubIssueCommentFactory
{
    /** @var GitHubIssueCommentAuthorFactory */
    private $authorFactory;

    public function __construct(GitHubIssueCommentAuthorFactory $authorFactory)
    {
        $this->authorFactory = $authorFactory;
    }

    public function create(array $data, IssueId $issueId): IssueCommentDetails
    {
        return new IssueCommentDetails(
            new IssueCommentId($data['id']),
            $issueId,
            new IssueCommentBody($data['body']),
            $this->authorFactory->create($data['user']),
            new IssueCommentCreatedAt($data['created_at']),
            new IssueCommentUpdatedAt($data['updated_at'])
        );
    }
}
