<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\HookFactory\Issue;

use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\CoreFactory\Issue\GitHubIssueFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\Issue\AssignedIssueEvent;
use DevboardLib\GitHubWebhook\Hook\Issue\ClosedIssueEvent;
use DevboardLib\GitHubWebhook\Hook\Issue\DemilestonedIssueEvent;
use DevboardLib\GitHubWebhook\Hook\Issue\EditedIssueEvent;
use DevboardLib\GitHubWebhook\Hook\Issue\IssueEvent;
use DevboardLib\GitHubWebhook\Hook\Issue\LabeledIssueEvent;
use DevboardLib\GitHubWebhook\Hook\Issue\MilestonedIssueEvent;
use DevboardLib\GitHubWebhook\Hook\Issue\OpenedIssueEvent;
use DevboardLib\GitHubWebhook\Hook\Issue\ReopenedIssueEvent;
use DevboardLib\GitHubWebhook\Hook\Issue\UnassignedIssueEvent;
use DevboardLib\GitHubWebhook\Hook\Issue\UnlabeledIssueEvent;
use DevboardLib\GitHubWebhook\HookFactory\GitHubHookEventFactory;
use Exception;

/**
 * @see IssueEventFactorySpec
 * @see IssueEventFactoryTest
 */
class IssueEventFactory implements GitHubHookEventFactory
{
    /** @var GitHubIssueFactory */
    private $issueFactory;

    /** @var RepoFactory */
    private $repoFactory;

    /** @var SenderFactory */
    private $senderFactory;

    /** @var array */
    private $list = [
        'assigned'     => AssignedIssueEvent::class,
        'unassigned'   => UnassignedIssueEvent::class,
        'labeled'      => LabeledIssueEvent::class,
        'unlabeled'    => UnlabeledIssueEvent::class,
        'opened'       => OpenedIssueEvent::class,
        'edited'       => EditedIssueEvent::class,
        'milestoned'   => MilestonedIssueEvent::class,
        'demilestoned' => DemilestonedIssueEvent::class,
        'closed'       => ClosedIssueEvent::class,
        'reopened'     => ReopenedIssueEvent::class,
    ];

    public function __construct(
        GitHubIssueFactory $issueFactory, RepoFactory $repoFactory, SenderFactory $senderFactory
    ) {
        $this->issueFactory  = $issueFactory;
        $this->repoFactory   = $repoFactory;
        $this->senderFactory = $senderFactory;
    }

    public function getSupportedEventType(): string
    {
        return 'issues';
    }

    public function create(array $data): IssueEvent
    {
        $action = $data['action'];

        if (false === array_key_exists($action, $this->list)) {
            throw new Exception('Unknonw action: '.$action);
        }

        $className = $this->list[$action];

        return new $className(
            $this->issueFactory->create($data['issue']),
            $this->repoFactory->create($data['repository']),
            new InstallationId($data['installation']['id']),
            $this->senderFactory->create($data['sender'])
        );
    }
}
