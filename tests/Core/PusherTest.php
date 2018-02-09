<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\GitHubWebhook\Core\Pusher;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Pusher
 * @group  unit
 */
class PusherTest extends TestCase
{
    /** @var string */
    private $name;

    /** @var EmailAddress */
    private $email;

    /** @var Pusher */
    private $sut;

    public function setUp()
    {
        $this->name  = 'Octo Cat';
        $this->email = new EmailAddress('octocat@example.com');
        $this->sut   = new Pusher($this->name, $this->email);
    }

    public function testGetName()
    {
        self::assertSame($this->name, $this->sut->getName());
    }

    public function testGetEmail()
    {
        self::assertSame($this->email, $this->sut->getEmail());
    }

    public function testSerialize()
    {
        $expected = ['name' => 'Octo Cat', 'email' => 'octocat@example.com'];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, Pusher::deserialize(json_decode($serialized, true)));
    }
}
