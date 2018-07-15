<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Push\Pusher;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Push\Pusher
 * @group  todo
 */
class PusherTest extends TestCase
{
    /** @var UserLogin */
    private $login;

    /** @var EmailAddress|null */
    private $emailAddress;

    /** @var Pusher */
    private $sut;

    public function setUp(): void
    {
        $this->login        = new UserLogin('Octo Cat');
        $this->emailAddress = new EmailAddress('octocat@example.com');
        $this->sut          = new Pusher($this->login, $this->emailAddress);
    }

    public function testGetLogin(): void
    {
        self::assertSame($this->login, $this->sut->getLogin());
    }

    public function testGetEmailAddress(): void
    {
        self::assertSame($this->emailAddress, $this->sut->getEmailAddress());
    }

    public function testHasEmailAddress(): void
    {
        self::assertTrue($this->sut->hasEmailAddress());
    }

    public function testSerialize(): void
    {
        $expected = ['login' => 'Octo Cat', 'emailAddress' => 'octocat@example.com'];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, Pusher::deserialize(json_decode($serialized, true)));
    }
}
