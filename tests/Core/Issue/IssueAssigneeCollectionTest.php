<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Issue;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHubWebhook\Core\Issue\IssueAssignee;
use DevboardLib\GitHubWebhook\Core\Issue\IssueAssigneeCollection;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Issue\IssueAssigneeCollection
 * @group  todo
 */
class IssueAssigneeCollectionTest extends TestCase
{
    /** @var array */
    private $elements = [];

    /** @var IssueAssigneeCollection */
    private $sut;

    public function setUp(): void
    {
        $this->elements = [
            new IssueAssignee(
                new AccountId(1),
                new AccountLogin('value'),
                AccountType::USER(),
                new AccountAvatarUrl('avatarUrl'),
                true
            ),
        ];
        $this->sut = new IssueAssigneeCollection($this->elements);
    }

    public function testGetElements(): void
    {
        self::assertSame($this->elements, $this->sut->toArray());
    }

    public function testSerializeAndDeserialize(): void
    {
        $serialized     = $this->sut->serialize();
        $serializedJson = json_encode($serialized);
        self::assertEquals($this->sut, $this->sut::deserialize(json_decode($serializedJson, true)));
    }
}
