<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\Status;

use DateTime;
use DevboardLib\GitHub\External\ExternalServiceFactory;
use DevboardLib\GitHub\StatusCheck\StatusCheckContext;
use DevboardLib\GitHub\StatusCheck\StatusCheckDescription;
use DevboardLib\GitHub\StatusCheck\StatusCheckId;
use DevboardLib\GitHub\StatusCheck\StatusCheckState;
use DevboardLib\GitHub\StatusCheck\StatusCheckTargetUrl;
use DevboardLib\GitHubWebhook\Core\GitHubStatusCheck;

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

    public function create(array $data): GitHubStatusCheck
    {
        $context = new StatusCheckContext($data['context']);

        return new GitHubStatusCheck(
            new StatusCheckId($data['id']),
            StatusCheckState::create($data['state']),
            new StatusCheckDescription($data['description']),
            new StatusCheckTargetUrl($data['target_url']),
            $context,
            $this->externalServiceFactory->create($context),
            $this->statusCreatorFactory->create($data['sender']),
            new DateTime($data['created_at']),
            new DateTime($data['updated_at'])
        );
    }
}
