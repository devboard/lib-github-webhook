<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core;

use DateTime;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\External\ExternalService;
use DevboardLib\GitHub\External\Service\ContinuousIntegration\CircleCi;
use DevboardLib\GitHub\StatusCheck\StatusCheckContext;
use DevboardLib\GitHub\StatusCheck\StatusCheckCreator;
use DevboardLib\GitHub\StatusCheck\StatusCheckDescription;
use DevboardLib\GitHub\StatusCheck\StatusCheckId;
use DevboardLib\GitHub\StatusCheck\StatusCheckState;
use DevboardLib\GitHub\StatusCheck\StatusCheckTargetUrl;
use DevboardLib\GitHubWebhook\Core\GitHubStatusCheck;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 * @covers \DevboardLib\GitHubWebhook\Core\GitHubStatusCheck
 * @group  unit
 */
class GitHubStatusCheckTest extends TestCase
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

    /** @var GitHubStatusCheck */
    private $sut;

    public function setUp(): void
    {
        $this->id              = new StatusCheckId(1);
        $this->state           = StatusCheckState::Pending();
        $this->description     = new StatusCheckDescription('value');
        $this->targetUrl       = new StatusCheckTargetUrl('https://circleci.com/gh/msvrtan/generator/231');
        $this->context         = new StatusCheckContext('ci/circleci');
        $this->externalService = new CircleCi($this->context);
        $this->creator         = new StatusCheckCreator(
            new AccountId(6752317),
            new AccountLogin('devboard-test'),
            new AccountType('Bot'),
            new AccountAvatarUrl('https://avatars.githubusercontent.com/u/6752317?v=3'),
            false
        );
        $this->createdAt = new DateTime('2018-01-01T00:01:00+00:00');
        $this->updatedAt = new DateTime('2018-01-01T00:01:00+00:00');
        $this->sut       = new GitHubStatusCheck(
            $this->id,
            $this->state,
            $this->description,
            $this->targetUrl,
            $this->context,
            $this->externalService,
            $this->creator,
            $this->createdAt,
            $this->updatedAt
        );
    }

    public function testGetId(): void
    {
        self::assertSame($this->id, $this->sut->getId());
    }

    public function testGetState(): void
    {
        self::assertSame($this->state, $this->sut->getState());
    }

    public function testGetDescription(): void
    {
        self::assertSame($this->description, $this->sut->getDescription());
    }

    public function testGetTargetUrl(): void
    {
        self::assertSame($this->targetUrl, $this->sut->getTargetUrl());
    }

    public function testGetContext(): void
    {
        self::assertSame($this->context, $this->sut->getContext());
    }

    public function testGetExternalService(): void
    {
        self::assertSame($this->externalService, $this->sut->getExternalService());
    }

    public function testGetCreator(): void
    {
        self::assertSame($this->creator, $this->sut->getCreator());
    }

    public function testGetCreatedAt(): void
    {
        self::assertSame($this->createdAt, $this->sut->getCreatedAt());
    }

    public function testGetUpdatedAt(): void
    {
        self::assertSame($this->updatedAt, $this->sut->getUpdatedAt());
    }

    public function testSerialize(): void
    {
        $expected = [
            'id'              => 1,
            'state'           => 'pending',
            'description'     => 'value',
            'targetUrl'       => 'https://circleci.com/gh/msvrtan/generator/231',
            'context'         => 'ci/circleci',
            'externalService' => [
                'context'   => 'ci/circleci',
                'className' => 'DevboardLib\GitHub\External\Service\ContinuousIntegration\CircleCi',
            ],
            'creator' => [
                'userId'    => 6752317,
                'login'     => 'devboard-test',
                'type'      => 'Bot',
                'avatarUrl' => 'https://avatars.githubusercontent.com/u/6752317?v=3',

                'siteAdmin' => false,
            ],
            'createdAt' => '2018-01-01T00:01:00+00:00',
            'updatedAt' => '2018-01-01T00:01:00+00:00',
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, GitHubStatusCheck::deserialize(json_decode($serialized, true)));
    }
}
