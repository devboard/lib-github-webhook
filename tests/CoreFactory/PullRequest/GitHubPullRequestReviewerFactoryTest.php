<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\CoreFactory\PullRequest;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\PullRequest\PullRequestReviewer;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\CoreFactory\PullRequest\GitHubPullRequestReviewerFactory
 * @group  unit
 */
class GitHubPullRequestReviewerFactoryTest extends TestCase
{
    /** @dataProvider provideArguments */
    public function testCreating(
        AccountId $userId,
        AccountLogin $login,
        AccountType $gitHubAccountType,
        AccountAvatarUrl $avatarUrl,
        bool $siteAdmin
    ): void {
        $sut = new PullRequestReviewer($userId, $login, $gitHubAccountType, $avatarUrl, $siteAdmin);

        $this->assertSame($userId, $sut->getUserId());
        $this->assertSame($login, $sut->getLogin());
        $this->assertSame($gitHubAccountType, $sut->getType());
        $this->assertSame($avatarUrl, $sut->getAvatarUrl());
        $this->assertSame($siteAdmin, $sut->isSiteAdmin());
    }

    /** @dataProvider provideArguments */
    public function testSerializationAndDeserialization(
        AccountId $userId,
        AccountLogin $login,
        AccountType $gitHubAccountType,
        AccountAvatarUrl $avatarUrl,
        bool $siteAdmin
    ): void {
        $sut = new PullRequestReviewer($userId, $login, $gitHubAccountType, $avatarUrl, $siteAdmin);

        $serialized = $sut->serialize();

        $this->assertEquals($sut, PullRequestReviewer::deserialize($serialized));
    }

    public function provideArguments(): array
    {
        return [
            [
                new AccountId(13507412),
                new AccountLogin('devboard-test'),
                AccountType::USER(),
                new AccountAvatarUrl('https://avatars.Usercontent.com/u/13507412?v=3'),
                false,
            ],
            [
                new AccountId(13396338),
                new AccountLogin('devboard'),
                AccountType::ORGANIZATION(),
                new AccountAvatarUrl('https://avatars.Usercontent.com/u/13396338?v=3'),
                false,
            ],
            [
                new AccountId(1),
                new AccountLogin('octocat'),
                AccountType::USER(),
                new AccountAvatarUrl('https://avatars.Usercontent.com/u/1?v=3'),
                true,
            ],
        ];
    }
}
