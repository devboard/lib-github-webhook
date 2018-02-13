<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\HookFactory\Status;

use DevboardLib\Git\Branch\BranchName;
use DevboardLib\GitHubWebhook\Core\Status\BranchNameCollection;
use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Status\CommitFactory;
use DevboardLib\GitHubWebhook\CoreFactory\Status\GitHubStatusFactory;
use DevboardLib\GitHubWebhook\Hook\Status\StatusEvent;
use DevboardLib\GitHubWebhook\HookFactory\GitHubHookEventFactory;

/**
 * @see StatusEventFactorySpec
 * @see StatusEventFactoryTest
 */
class StatusEventFactory implements GitHubHookEventFactory
{
    /** @var GitHubStatusFactory */
    private $statusFactory;

    /** @var CommitFactory */
    private $commitFactory;

    /** @var RepoFactory */
    private $repoFactory;

    /** @var SenderFactory */
    private $senderFactory;

    public function __construct(
        GitHubStatusFactory $statusFactory,
        CommitFactory $commitFactory,
        RepoFactory $repoFactory,
        SenderFactory $senderFactory
    ) {
        $this->statusFactory = $statusFactory;
        $this->commitFactory = $commitFactory;
        $this->repoFactory   = $repoFactory;
        $this->senderFactory = $senderFactory;
    }

    public function getSupportedEventType(): string
    {
        return 'status';
    }

    public function create(array $data): StatusEvent
    {
        $branches = new BranchNameCollection();

        foreach ($data['branches'] as $branch) {
            $branches->add(new BranchName($branch['name']));
        }

        return new StatusEvent(
            $this->statusFactory->create($data),
            $this->commitFactory->create($data['commit']),
            $this->repoFactory->create($data['repository']),
            $branches,
            $this->senderFactory->create($data['sender'])
        );
    }
}
