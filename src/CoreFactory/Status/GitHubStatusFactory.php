<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\Status;

use DateTime;
use DevboardLib\GitHub\External\ExternalServiceFactory;
use DevboardLib\GitHub\GitHubStatus;
use DevboardLib\GitHub\Status\StatusContext;
use DevboardLib\GitHub\Status\StatusDescription;
use DevboardLib\GitHub\Status\StatusId;
use DevboardLib\GitHub\Status\StatusState;
use DevboardLib\GitHub\Status\StatusTargetUrl;

/**
 * @see GitHubStatusFactorySpec
 * @see GitHubStatusFactoryTest
 */
class GitHubStatusFactory
{
    /** @var GitHubStatusCreatorFactory */
    private $statusCreatorFactory;

    /** @var ExternalServiceFactory */
    private $externalServiceFactory;

    public function __construct(
        GitHubStatusCreatorFactory $statusCreatorFactory, ExternalServiceFactory $externalServiceFactory
    ) {
        $this->statusCreatorFactory   = $statusCreatorFactory;
        $this->externalServiceFactory = $externalServiceFactory;
    }

    public function create(array $data): GitHubStatus
    {
        $context = new StatusContext($data['context']);

        return new GitHubStatus(
            new StatusId($data['id']),
            StatusState::create($data['state']),
            new StatusDescription($data['description']),
            new StatusTargetUrl($data['target_url']),
            $context,
            $this->externalServiceFactory->create($context),
            $this->statusCreatorFactory->create($data['sender']),
            new DateTime($data['created_at']),
            new DateTime($data['updated_at'])
        );
    }
}
