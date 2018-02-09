<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Push\Pusher;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Push\Pusher
 * @group  unit
 */
class PusherTest extends TestCase
{
    /** @dataProvider provideValues */
    public function testGetters(UserLogin $login, EmailAddress $emailAddress)
    {
        $sut = new Pusher($login, $emailAddress);

        $this->assertEquals($login, $sut->getLogin());
        $this->assertEquals($emailAddress, $sut->getEmailAddress());
    }

    /** @dataProvider provideStringValues */
    public function testItCanBeCreatedFromStrings(string $login, string $emailAddress)
    {
        $this->assertInstanceOf(Pusher::class, Pusher::create($login, $emailAddress));
    }

    public function provideValues(): array
    {
        return [[new UserLogin('devboard-test'), new EmailAddress('nobody@example.com')]];
    }

    public function provideStringValues(): array
    {
        return [['devboard-test', 'nobody@example.com']];
    }
}
