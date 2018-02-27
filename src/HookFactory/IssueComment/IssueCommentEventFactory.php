<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\HookFactory\IssueComment;

use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\CoreFactory\Issue\GitHubIssueFactory;
use DevboardLib\GitHubWebhook\CoreFactory\IssueComment\GitHubIssueCommentFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\IssueComment\CreatedIssueCommentEvent;
use DevboardLib\GitHubWebhook\Hook\IssueComment\DeletedIssueCommentEvent;
use DevboardLib\GitHubWebhook\Hook\IssueComment\EditedIssueCommentEvent;
use DevboardLib\GitHubWebhook\Hook\IssueComment\IssueCommentEvent;
use DevboardLib\GitHubWebhook\HookFactory\GitHubHookEventFactory;
use Exception;

/**
 * @see IssueCommentEventFactorySpec
 * @see IssueCommentEventFactoryTest
 */
class IssueCommentEventFactory implements GitHubHookEventFactory
{
    /** @var GitHubIssueCommentFactory */
    private $issueCommentFactory;

    /** @var GitHubIssueFactory */
    private $issueFactory;

    /** @var RepoFactory */
    private $repoFactory;

    /** @var SenderFactory */
    private $senderFactory;

    public function __construct(
        GitHubIssueCommentFactory $issueCommentFactory,
        GitHubIssueFactory $issueFactory,
        RepoFactory $repoFactory,
        SenderFactory $senderFactory
    ) {
        $this->issueCommentFactory = $issueCommentFactory;
        $this->issueFactory        = $issueFactory;
        $this->repoFactory         = $repoFactory;
        $this->senderFactory       = $senderFactory;
    }

    public function getSupportedEventType(): string
    {
        return 'issue_comment';
    }

    public function create(array $data): IssueCommentEvent
    {
        $issue          = $this->issueFactory->create($data['issue']);
        $issueComment   = $this->issueCommentFactory->create($data['comment'], $issue->getId());
        $installationId = new InstallationId($data['installation']['id']);
        $repo           = $this->repoFactory->create($data['repository']);
        $sender         = $this->senderFactory->create($data['sender']);

        if ('created' === $data['action']) {
            return new CreatedIssueCommentEvent($issueComment, $issue, $repo, $installationId, $sender);
        } elseif ('edited' === $data['action']) {
            return new EditedIssueCommentEvent($issueComment, $issue, $repo, $installationId, $sender);
        } elseif ('deleted' === $data['action']) {
            return new DeletedIssueCommentEvent($issueComment, $issue, $repo, $installationId, $sender);
        } else {
            throw new Exception('UNSUPPORTED ISSUE COMMENT ACTION:'.$data['action']);
        }
    }
}
