<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\HookFactory\PullRequestReview;

use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview\GitHubPullRequestFactory;
use DevboardLib\GitHubWebhook\CoreFactory\PullRequestReview\GitHubPullRequestReviewFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\PullRequestReview\DismissedPullRequestReview;
use DevboardLib\GitHubWebhook\Hook\PullRequestReview\EditedPullRequestReview;
use DevboardLib\GitHubWebhook\Hook\PullRequestReview\PullRequestReviewEvent;
use DevboardLib\GitHubWebhook\Hook\PullRequestReview\SubmittedPullRequestReview;
use DevboardLib\GitHubWebhook\HookFactory\GitHubHookEventFactory;
use Exception;

/**
 * @see PullRequestReviewEventFactorySpec
 * @see PullRequestReviewEventFactoryTest
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class PullRequestReviewEventFactory implements GitHubHookEventFactory
{
    /** @var GitHubPullRequestReviewFactory */
    private $pullRequestReviewFactory;

    /** @var GitHubPullRequestFactory */
    private $pullRequestFactory;

    /** @var RepoFactory */
    private $repoFactory;

    /** @var SenderFactory */
    private $senderFactory;

    public function __construct(
        GitHubPullRequestReviewFactory $pullRequestReviewFactory,
        GitHubPullRequestFactory $pullRequestFactory,
        RepoFactory $repoFactory,
        SenderFactory $senderFactory
    ) {
        $this->pullRequestReviewFactory = $pullRequestReviewFactory;

        $this->pullRequestFactory = $pullRequestFactory;
        $this->repoFactory        = $repoFactory;
        $this->senderFactory      = $senderFactory;
    }

    public function getSupportedEventType(): string
    {
        return 'pull_request_review';
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     */
    public function create(array $data): PullRequestReviewEvent
    {
        $action = $data['action'];

        $review         = $this->pullRequestReviewFactory->create($data['review']);
        $pullRequest    = $this->pullRequestFactory->create($data['pull_request']);
        $repo           = $this->repoFactory->create($data['repository']);
        $installationId = new InstallationId($data['installation']['id']);
        $sender         = $this->senderFactory->create($data['sender']);

        if ('submitted' === $action) {
            return new SubmittedPullRequestReview($review, $pullRequest, $repo, $installationId, $sender);
        } elseif ('edited' === $action) {
            return new EditedPullRequestReview($review, $pullRequest, $repo, $installationId, $sender);
        } elseif ('dismissed' === $action) {
            return new DismissedPullRequestReview($review, $pullRequest, $repo, $installationId, $sender);
        }
        throw new Exception('UNSUPPORTED PULL REQUEST REVIEW ACTION:'.$data['action']);
    }
}
