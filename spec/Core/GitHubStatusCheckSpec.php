<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core;

use DateTime;
use DevboardLib\GitHub\External\ExternalService;
use DevboardLib\GitHub\StatusCheck\StatusCheckContext;
use DevboardLib\GitHub\StatusCheck\StatusCheckCreator;
use DevboardLib\GitHub\StatusCheck\StatusCheckDescription;
use DevboardLib\GitHub\StatusCheck\StatusCheckId;
use DevboardLib\GitHub\StatusCheck\StatusCheckState;
use DevboardLib\GitHub\StatusCheck\StatusCheckTargetUrl;
use DevboardLib\GitHubWebhook\Core\GitHubStatusCheck;
use PhpSpec\ObjectBehavior;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 */
class GitHubStatusCheckSpec extends ObjectBehavior
{
    public function let(
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
        $this->beConstructedWith(
            $id, $state, $description, $targetUrl, $context, $externalService, $creator, $createdAt, $updatedAt
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GitHubStatusCheck::class);
    }

    public function it_exposes_id(StatusCheckId $id)
    {
        $this->getId()->shouldReturn($id);
    }

    public function it_exposes_state(StatusCheckState $state)
    {
        $this->getState()->shouldReturn($state);
    }

    public function it_exposes_description(StatusCheckDescription $description)
    {
        $this->getDescription()->shouldReturn($description);
    }

    public function it_exposes_target_url(StatusCheckTargetUrl $targetUrl)
    {
        $this->getTargetUrl()->shouldReturn($targetUrl);
    }

    public function it_exposes_context(StatusCheckContext $context)
    {
        $this->getContext()->shouldReturn($context);
    }

    public function it_exposes_external_service(ExternalService $externalService)
    {
        $this->getExternalService()->shouldReturn($externalService);
    }

    public function it_exposes_creator(StatusCheckCreator $creator)
    {
        $this->getCreator()->shouldReturn($creator);
    }

    public function it_exposes_created_at(DateTime $createdAt)
    {
        $this->getCreatedAt()->shouldReturn($createdAt);
    }

    public function it_exposes_updated_at(DateTime $updatedAt)
    {
        $this->getUpdatedAt()->shouldReturn($updatedAt);
    }

    public function it_can_be_serialized(
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
        $id->serialize()->shouldBeCalled()->willReturn(123455567);
        $state->serialize()->shouldBeCalled()->willReturn('success');
        $description->serialize()->shouldBeCalled()->willReturn('status-description');
        $targetUrl->serialize()->shouldBeCalled()->willReturn(
            'https://circleci.com/gh/msvrtan/generator/231?utm_campaign=vcs-integration-link&utm_medium=referral&utm_source=github-build-link'
        );
        $context->serialize()->shouldBeCalled()->willReturn('ci/circleci');
        $externalService->serialize()->shouldBeCalled()->willReturn(
            [
                'context'   => 'ci/circleci',
                'className' => 'DevboardLib\GitHub\External\Service\ContinuousIntegration\CircleCi',
            ]
        );
        $creator->serialize()->shouldBeCalled()->willReturn(
            [
                'userId'    => 6752317,
                'login'     => 'devboard-test',
                'type'      => 'Bot',
                'avatarUrl' => 'https://avatars.githubusercontent.com/u/6752317?v=3',
                'siteAdmin' => false,
            ]
        );
        $createdAt->format('c')->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $updatedAt->format('c')->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $this->serialize()->shouldReturn(
            [
                'id'              => 123455567,
                'state'           => 'success',
                'description'     => 'status-description',
                'targetUrl'       => 'https://circleci.com/gh/msvrtan/generator/231?utm_campaign=vcs-integration-link&utm_medium=referral&utm_source=github-build-link',
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
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'id'              => 123455567,
            'state'           => 'success',
            'description'     => 'status-description',
            'targetUrl'       => 'https://circleci.com/gh/msvrtan/generator/231?utm_campaign=vcs-integration-link&utm_medium=referral&utm_source=github-build-link',
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

        $this->deserialize($input)->shouldReturnAnInstanceOf(GitHubStatusCheck::class);
    }
}
