<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\Milestone;

use DevboardLib\GitHub\Milestone\MilestoneClosedAt;
use DevboardLib\GitHub\Milestone\MilestoneCreatedAt;
use DevboardLib\GitHub\Milestone\MilestoneDescription;
use DevboardLib\GitHub\Milestone\MilestoneDueOn;
use DevboardLib\GitHub\Milestone\MilestoneId;
use DevboardLib\GitHub\Milestone\MilestoneNumber;
use DevboardLib\GitHub\Milestone\MilestoneState;
use DevboardLib\GitHub\Milestone\MilestoneTitle;
use DevboardLib\GitHub\Milestone\MilestoneUpdatedAt;
use DevboardLib\GitHubWebhook\Core\Milestone\MilestoneDetails;

/**
 * @see GitHubMilestoneFactorySpec
 * @see GitHubMilestoneFactoryTest
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class GitHubMilestoneFactory
{
    /** @var GitHubMilestoneCreatorFactory */
    private $creatorFactory;

    public function __construct(GitHubMilestoneCreatorFactory $creatorFactory)
    {
        $this->creatorFactory = $creatorFactory;
    }

    public function create(array $data): MilestoneDetails
    {
        if (null === $data['due_on']) {
            $dueOn = null;
        } else {
            $dueOn = new MilestoneDueOn($data['due_on']);
        }
        if (null === $data['closed_at']) {
            $closedAt = null;
        } else {
            $closedAt = new MilestoneClosedAt($data['closed_at']);
        }

        return new MilestoneDetails(
            new MilestoneId($data['id']),
            new MilestoneTitle($data['title']),
            new MilestoneDescription($data['description']),
            $dueOn,
            new MilestoneState($data['state']),
            new MilestoneNumber($data['number']),
            $this->creatorFactory->create($data['creator']),
            $closedAt,
            new MilestoneCreatedAt($data['created_at']),
            new MilestoneUpdatedAt($data['updated_at'])
        );
    }
}
