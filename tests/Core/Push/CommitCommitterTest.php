<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\Committer\CommitterName;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Push\CommitCommitter;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Push\CommitCommitter
 * @group  unit
 */
class CommitCommitterTest extends TestCase
{
    /** @var CommitterName */
    private $name;

    /** @var EmailAddress */
    private $email;

    /** @var UserLogin */
    private $username;

    /** @var CommitCommitter */
    private $sut;

    public function setUp()
    {
        $this->name     = new CommitterName('Octo Cat');
        $this->email    = new EmailAddress('octocat@example.com');
        $this->username = new UserLogin('octocat');
        $this->sut      = new CommitCommitter($this->name, $this->email, $this->username);
    }

    public function testGetName()
    {
        self::assertSame($this->name, $this->sut->getName());
    }

    public function testGetEmail()
    {
        self::assertSame($this->email, $this->sut->getEmail());
    }

    public function testGetUsername()
    {
        self::assertSame($this->username, $this->sut->getUsername());
    }

    public function testSerialize()
    {
        $expected = ['name' => 'Octo Cat', 'email' => 'octocat@example.com', 'username' => 'octocat'];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, CommitCommitter::deserialize(json_decode($serialized, true)));
    }
}
