<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core;

use DateTime;
use DevboardLib\GitHub\External\ExternalService;
use DevboardLib\GitHub\StatusCheck\StatusCheckContext;
use DevboardLib\GitHub\StatusCheck\StatusCheckCreator;
use DevboardLib\GitHub\StatusCheck\StatusCheckDescription;
use DevboardLib\GitHub\StatusCheck\StatusCheckId;
use DevboardLib\GitHub\StatusCheck\StatusCheckState;
use DevboardLib\GitHub\StatusCheck\StatusCheckTargetUrl;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\GitHubStatusCheckSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\GitHubStatusCheckTest
 */
class GitHubStatusCheck
{
    /** @var StatusCheckId */
    private $id;

    /** @var StatusCheckState */
    private $state;

    /** @var StatusCheckDescription */
    private $description;

    /** @var StatusCheckTargetUrl */
    private $targetUrl;

    /** @var StatusCheckContext */
    private $context;

    /** @var ExternalService */
    private $externalService;

    /** @var StatusCheckCreator */
    private $creator;

    /** @var DateTime */
    private $createdAt;

    /** @var DateTime */
    private $updatedAt;

    public function __construct(
        StatusCheckId $id,
        StatusCheckState $state,
        StatusCheckDescription $description,
        StatusCheckTargetUrl $targetUrl,
        StatusCheckContext $context,
        ExternalService $externalService,
        StatusCheckCreator $creator,
        DateTime $createdAt,
        DateTime $updatedAt
    ) {
        $this->id              = $id;
        $this->state           = $state;
        $this->description     = $description;
        $this->targetUrl       = $targetUrl;
        $this->context         = $context;
        $this->externalService = $externalService;
        $this->creator         = $creator;
        $this->createdAt       = $createdAt;
        $this->updatedAt       = $updatedAt;
    }

    public function getId(): StatusCheckId
    {
        return $this->id;
    }

    public function getState(): StatusCheckState
    {
        return $this->state;
    }

    public function getDescription(): StatusCheckDescription
    {
        return $this->description;
    }

    public function getTargetUrl(): StatusCheckTargetUrl
    {
        return $this->targetUrl;
    }

    public function getContext(): StatusCheckContext
    {
        return $this->context;
    }

    public function getExternalService(): ExternalService
    {
        return $this->externalService;
    }

    public function getCreator(): StatusCheckCreator
    {
        return $this->creator;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function serialize(): array
    {
        return [
            'id'              => $this->id->serialize(),
            'state'           => $this->state->serialize(),
            'description'     => $this->description->serialize(),
            'targetUrl'       => $this->targetUrl->serialize(),
            'context'         => $this->context->serialize(),
            'externalService' => $this->externalService->serialize(),
            'creator'         => $this->creator->serialize(),
            'createdAt'       => $this->createdAt->format('c'),
            'updatedAt'       => $this->updatedAt->format('c'),
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            StatusCheckId::deserialize($data['id']),
            StatusCheckState::deserialize($data['state']),
            StatusCheckDescription::deserialize($data['description']),
            StatusCheckTargetUrl::deserialize($data['targetUrl']),
            StatusCheckContext::deserialize($data['context']),
            ExternalService::deserialize($data['externalService']),
            StatusCheckCreator::deserialize($data['creator']),
            new DateTime($data['createdAt']),
            new DateTime($data['updatedAt'])
        );
    }
}
