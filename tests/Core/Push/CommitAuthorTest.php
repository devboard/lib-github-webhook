<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\Author\AuthorName;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Push\CommitAuthor;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\Push\CommitAuthor
 * @group  unit
 */
class CommitAuthorTest extends TestCase
{
    /** @var AuthorName */
    private $name;

    /** @var EmailAddress */
    private $email;

    /** @var UserLogin */
    private $username;

    /** @var CommitAuthor */
    private $sut;

    public function setUp()
    {
        $this->name     = new AuthorName('Octo Cat');
        $this->email    = new EmailAddress('octocat@example.com');
        $this->username = new UserLogin('octocat');
        $this->sut      = new CommitAuthor($this->name, $this->email, $this->username);
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
        self::assertEquals($this->sut, CommitAuthor::deserialize(json_decode($serialized, true)));
    }
}
