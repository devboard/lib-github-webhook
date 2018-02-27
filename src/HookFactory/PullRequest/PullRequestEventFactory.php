<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\HookFactory\PullRequest;

use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\CoreFactory\Label\GitHubLabelFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestAssigneeFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestReviewerFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\PullRequest\AssignedPullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\ClosedPullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\EditedPullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\LabeledPullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\MergedPullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\OpenedPullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\PullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\ReopenedPullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\ReviewRequestedPullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\ReviewRequestRemovedPullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\SynchronizePullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\UnassignedPullRequestEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequest\UnlabeledPullRequestEvent;
use DevboardLib\GitHubWebhook\HookFactory\GitHubHookEventFactory;
use Exception;

/**
 * @see PullRequestEventFactorySpec
 * @see PullRequestEventFactoryTest
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class PullRequestEventFactory implements GitHubHookEventFactory
{
    /** @var GitHubPullRequestFactory */
    private $pullRequestFactory;

    /** @var RepoFactory */
    private $repoFactory;

    /** @var SenderFactory */
    private $senderFactory;

    /** @var GitHubLabelFactory */
    private $labelFactory;

    /** @var GitHubPullRequestAssigneeFactory */
    private $assigneeFactory;

    /** @var GitHubPullRequestReviewerFactory */
    private $reviewerFactory;

    public function __construct(
        GitHubPullRequestFactory $pullRequestFactory,
        RepoFactory $repoFactory,
        SenderFactory $senderFactory,
        GitHubLabelFactory $labelFactory,
        GitHubPullRequestAssigneeFactory $assigneeFactory,
        GitHubPullRequestReviewerFactory $reviewerFactory
    ) {
        $this->pullRequestFactory = $pullRequestFactory;
        $this->repoFactory        = $repoFactory;
        $this->senderFactory      = $senderFactory;
        $this->labelFactory       = $labelFactory;
        $this->assigneeFactory    = $assigneeFactory;
        $this->reviewerFactory    = $reviewerFactory;
    }

    public function getSupportedEventType(): string
    {
        return 'pull_request';
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function create(array $data): PullRequestEvent
    {
        $action = $data['action'];

        $pullRequest    = $this->pullRequestFactory->create($data['pull_request']);
        $repo           = $this->repoFactory->create($data['repository']);
        $installationId = new InstallationId($data['installation']['id']);
        $sender         = $this->senderFactory->create($data['sender']);

        if ('opened' === $action) {
            return new OpenedPullRequestEvent($pullRequest, $repo, $installationId, $sender);
        } elseif ('reopened' === $action) {
            return new ReopenedPullRequestEvent($pullRequest, $repo, $installationId, $sender);
        } elseif ('edited' === $action) {
            return new EditedPullRequestEvent($pullRequest, $repo, $installationId, $sender);
        } elseif ('closed' === $action && false === $data['pull_request']['merged']) {
            return new ClosedPullRequestEvent($pullRequest, $repo, $installationId, $sender);
        } elseif ('closed' === $action && true === $data['pull_request']['merged']) {
            return new MergedPullRequestEvent($pullRequest, $repo, $installationId, $sender);
        } elseif ('synchronize' === $action) {
            return new SynchronizePullRequestEvent($pullRequest, $repo, $installationId, $sender);
        } elseif ('labeled' === $action) {
            $label = $this->labelFactory->create($data['label']);

            return new LabeledPullRequestEvent($pullRequest, $label, $repo, $installationId, $sender);
        } elseif ('unlabeled' === $action) {
            $label = $this->labelFactory->create($data['label']);

            return new UnlabeledPullRequestEvent($pullRequest, $label, $repo, $installationId, $sender);
        } elseif ('review_requested' === $action) {
            $reviewer = $this->reviewerFactory->create($data['requested_reviewer']);

            return new ReviewRequestedPullRequestEvent($pullRequest, $reviewer, $repo, $installationId, $sender);
        } elseif ('review_request_removed' === $action) {
            $reviewer = $this->reviewerFactory->create($data['requested_reviewer']);

            return new ReviewRequestRemovedPullRequestEvent($pullRequest, $reviewer, $repo, $installationId, $sender);
        } elseif ('assigned' === $action) {
            $assignee = $this->assigneeFactory->create($data['assignee']);

            return new AssignedPullRequestEvent($pullRequest, $assignee, $repo, $installationId, $sender);
        } elseif ('unassigned' === $action) {
            $assignee = $this->assigneeFactory->create($data['assignee']);

            return new UnassignedPullRequestEvent($pullRequest, $assignee, $repo, $installationId, $sender);
        }

        throw new Exception('UNSUPPORTED PULL REQUEST ACTION:'.$data['action']);
    }
}
