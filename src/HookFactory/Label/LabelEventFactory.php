<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\HookFactory\Label;

use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\CoreFactory\Label\GitHubLabelFactory;
use DevboardLib\GitHubWebhook\CoreFactory\RepoFactory;
use DevboardLib\GitHubWebhook\CoreFactory\SenderFactory;
use DevboardLib\GitHubWebhook\Hook\Label\CreatedLabelEvent;
use DevboardLib\GitHubWebhook\Hook\Label\DeletedLabelEvent;
use DevboardLib\GitHubWebhook\Hook\Label\EditedLabelEvent;
use DevboardLib\GitHubWebhook\Hook\Label\LabelEvent;
use DevboardLib\GitHubWebhook\HookFactory\GitHubHookEventFactory;
use Exception;

/**
 * @see LabelEventFactorySpec
 * @see LabelEventFactoryTest
 */
class LabelEventFactory implements GitHubHookEventFactory
{
    /** @var GitHubLabelFactory */
    private $labelFactory;

    /** @var RepoFactory */
    private $repoFactory;

    /** @var SenderFactory */
    private $senderFactory;

    /** @var array */
    private $list = [
        'created' => CreatedLabelEvent::class,
        'edited'  => EditedLabelEvent::class,
        'deleted' => DeletedLabelEvent::class,
    ];

    public function __construct(
        GitHubLabelFactory $labelFactory, RepoFactory $repoFactory, SenderFactory $senderFactory
    ) {
        $this->labelFactory  = $labelFactory;
        $this->repoFactory   = $repoFactory;
        $this->senderFactory = $senderFactory;
    }

    public function getSupportedEventType(): string
    {
        return 'label';
    }

    public function create(array $data): LabelEvent
    {
        $action = $data['action'];

        if (false === array_key_exists($action, $this->list)) {
            throw new Exception('Unknown action: '.$action);
        }

        $className = $this->list[$action];

        return new $className(
            $this->labelFactory->create($data['label']),
            $this->repoFactory->create($data['repository']),
            new InstallationId($data['installation']['id']),
            $this->senderFactory->create($data['sender'])
        );
    }
}
