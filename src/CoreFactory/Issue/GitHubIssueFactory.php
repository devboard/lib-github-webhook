<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\Issue;

use DevboardLib\GitHub\GitHubIssue;
use DevboardLib\GitHub\GitHubLabelCollection;
use DevboardLib\GitHub\Issue\IssueAssigneeCollection;
use DevboardLib\GitHub\Issue\IssueBody;
use DevboardLib\GitHub\Issue\IssueClosedAt;
use DevboardLib\GitHub\Issue\IssueCreatedAt;
use DevboardLib\GitHub\Issue\IssueId;
use DevboardLib\GitHub\Issue\IssueNumber;
use DevboardLib\GitHub\Issue\IssueState;
use DevboardLib\GitHub\Issue\IssueTitle;
use DevboardLib\GitHub\Issue\IssueUpdatedAt;
use DevboardLib\GitHubWebhook\CoreFactory\Label\GitHubLabelFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Milestone\GitHubMilestoneFactory;

/**
 * @see GitHubIssueFactorySpec
 * @see GitHubIssueFactoryTest
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class GitHubIssueFactory
{
    /** @var GitHubIssueAuthorFactory */
    private $authorFactory;

    /** @var GitHubIssueAssigneeFactory */
    private $assigneeFactory;

    /** @var GitHubLabelFactory */
    private $labelFactory;

    /** @var GitHubMilestoneFactory */
    private $milestoneFactory;

    public function __construct(
        GitHubIssueAuthorFactory $authorFactory,
        GitHubIssueAssigneeFactory $assigneeFactory,
        GitHubLabelFactory $labelFactory,
        GitHubMilestoneFactory $milestoneFactory
    ) {
        $this->authorFactory    = $authorFactory;
        $this->assigneeFactory  = $assigneeFactory;
        $this->labelFactory     = $labelFactory;
        $this->milestoneFactory = $milestoneFactory;
    }

    public function create(array $data): GitHubIssue
    {
        if (null === $data['assignee']) {
            $assignee = null;
        } else {
            $assignee = $this->assigneeFactory->create($data['assignee']);
        }

        if (null === $data['closed_at']) {
            $closedAt = null;
        } else {
            $closedAt = new IssueClosedAt($data['closed_at']);
        }

        $assignees = new IssueAssigneeCollection([]);

        foreach ($data['assignees'] as $assigneeData) {
            $assignees->add($this->assigneeFactory->create($assigneeData));
        }

        $labels = new GitHubLabelCollection([]);

        foreach ($data['labels'] as $labelData) {
            $labels->add($this->labelFactory->create($labelData));
        }

        if (null === $data['milestone']) {
            $milestone = null;
        } else {
            $milestone = $this->milestoneFactory->create($data['milestone']);
        }

        return new GitHubIssue(
            new IssueId($data['id']),
            new IssueNumber($data['number']),
            new IssueTitle($data['title']),
            new IssueBody((string) $data['body']),
            new IssueState($data['state']),
            $this->authorFactory->create($data['user']),
            $assignee,
            $assignees,
            $labels,
            $milestone,
            $closedAt,
            new IssueCreatedAt($data['created_at']),
            new IssueUpdatedAt($data['updated_at'])
        );
    }
}
