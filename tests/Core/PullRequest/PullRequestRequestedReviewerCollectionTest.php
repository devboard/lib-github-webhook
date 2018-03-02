<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\Generix\GravatarId;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\User\UserApiUrl;
use DevboardLib\GitHub\User\UserAvatarUrl;
use DevboardLib\GitHub\User\UserHtmlUrl;
use DevboardLib\GitHub\User\UserId;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedReviewer;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedReviewerCollection;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedReviewerCollection
 * @group  unit
 */
class PullRequestRequestedReviewerCollectionTest extends TestCase
{
    /** @var array */
    private $elements = [];

    /** @var PullRequestRequestedReviewerCollection */
    private $sut;

    public function setUp()
    {
        $this->elements = [
            new PullRequestRequestedReviewer(
                new UserId(1),
                new UserLogin('value'),
                AccountType::USER(),
                new UserAvatarUrl('avatarUrl'),
                new GravatarId('id'),
                new UserHtmlUrl('htmlUrl'),
                new UserApiUrl('apiUrl'),
                true,
                'eventsUrl',
                'followersUrl',
                'followingUrl',
                'gistsUrl',
                'organizationsUrl',
                'receivedEventsUrl',
                'reposUrl',
                'starredUrl',
                'subscriptionsUrl'
            ),
        ];
        $this->sut = new PullRequestRequestedReviewerCollection($this->elements);
    }

    public function testGetElements()
    {
        self::assertSame($this->elements, $this->sut->toArray());
    }

    public function testSerializeAndDeserialize()
    {
        $serialized     = $this->sut->serialize();
        $serializedJson = json_encode($serialized);
        self::assertEquals($this->sut, $this->sut->deserialize(json_decode($serializedJson, true)));
    }
}
