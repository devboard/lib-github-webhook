<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core;

use Data\DevboardLib\GitHubWebhook\Core\RepoOwnerSample;
use DevboardLib\Git\Branch\BranchName;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Repo\RepoCreatedAt;
use DevboardLib\GitHub\Repo\RepoDescription;
use DevboardLib\GitHub\Repo\RepoEndpoints;
use DevboardLib\GitHub\Repo\RepoEndpoints\RepoApiUrl;
use DevboardLib\GitHub\Repo\RepoEndpoints\RepoGitUrl;
use DevboardLib\GitHub\Repo\RepoEndpoints\RepoHtmlUrl;
use DevboardLib\GitHub\Repo\RepoEndpoints\RepoSshUrl;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoHomepage;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHub\Repo\RepoLanguage;
use DevboardLib\GitHub\Repo\RepoMirrorUrl;
use DevboardLib\GitHub\Repo\RepoName;
use DevboardLib\GitHub\Repo\RepoParent;
use DevboardLib\GitHub\Repo\RepoPushedAt;
use DevboardLib\GitHub\Repo\RepoStats;
use DevboardLib\GitHub\Repo\RepoStats\RepoSize;
use DevboardLib\GitHub\Repo\RepoTimestamps;
use DevboardLib\GitHub\Repo\RepoUpdatedAt;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\RepoAdditionalDetails;
use DevboardLib\GitHubWebhook\Core\RepoAdditionalUrls;
use DevboardLib\GitHubWebhook\Core\RepoOwner;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 *
 * @covers \DevboardLib\GitHubWebhook\Core\Repo
 * @group  unit
 */
class RepoTest extends TestCase
{
    /** @var RepoId */
    private $id;

    /** @var RepoFullName */
    private $fullName;

    /** @var RepoOwner */
    private $owner;

    /** @var bool */
    private $private;

    /** @var BranchName */
    private $defaultBranch;

    /** @var bool */
    private $fork;

    /** @var RepoParent|null */
    private $parent;

    /** @var RepoDescription|null */
    private $description;

    /** @var RepoHomepage|null */
    private $homepage;

    /** @var RepoLanguage|null */
    private $language;

    /** @var RepoMirrorUrl|null */
    private $mirrorUrl;

    /** @var bool|null */
    private $archived;

    /** @var RepoEndpoints */
    private $endpoints;

    /** @var RepoStats */
    private $stats;

    /** @var RepoTimestamps */
    private $timestamps;

    /** @var RepoAdditionalDetails */
    private $additionalDetails;

    /** @var RepoAdditionalUrls */
    private $repoAdditionalUrls;

    /** @var Repo */
    private $sut;

    public function setUp(): void
    {
        $this->id            = new RepoId(64778136);
        $this->fullName      = new RepoFullName(new AccountLogin('value'), new RepoName('name'));
        $this->owner         = RepoOwnerSample::octocat();
        $this->private       = false;
        $this->defaultBranch = new BranchName('master');
        $this->fork          = false;
        $this->parent        = new RepoParent(
            new RepoId(1), new RepoFullName(new AccountLogin('value'), new RepoName('name'))
        );
        $this->description = new RepoDescription(
            'Language Savant. If your repository language is being reported incorrectly, send us a pull request!'
        );
        $this->homepage  = new RepoHomepage('http://www.example.com/');
        $this->language  = new RepoLanguage('PHP');
        $this->mirrorUrl = new RepoMirrorUrl('http://mirror.example.com');
        $this->archived  = false;
        $this->endpoints = new RepoEndpoints(
            new RepoHtmlUrl('htmlUrl'),
            new RepoApiUrl('apiUrl'),
            new RepoGitUrl('gitUrl'),
            new RepoSshUrl('sshUrl')
        );
        $this->stats      = new RepoStats(1, 1, 1, 1, 1, new RepoSize(1));
        $this->timestamps = new RepoTimestamps(
            new RepoCreatedAt('2018-01-01T00:01:00+00:00'),
            new RepoUpdatedAt('2018-01-01T00:01:00+00:00'),
            new RepoPushedAt('2018-01-01T00:01:00+00:00')
        );
        $this->additionalDetails  = new RepoAdditionalDetails('master', 0, true, true, true, true, true);
        $this->repoAdditionalUrls = RepoAdditionalUrlsTest::provideExample();

        $this->sut = new Repo(
            $this->id,
            $this->fullName,
            $this->owner,
            $this->private,
            $this->defaultBranch,
            $this->fork,
            $this->parent,
            $this->description,
            $this->homepage,
            $this->language,
            $this->mirrorUrl,
            $this->archived,
            $this->endpoints,
            $this->stats,
            $this->timestamps,
            $this->additionalDetails,
            $this->repoAdditionalUrls
        );
    }

    public function testGetId(): void
    {
        self::assertSame($this->id, $this->sut->getId());
    }

    public function testGetFullName(): void
    {
        self::assertSame($this->fullName, $this->sut->getFullName());
    }

    public function testGetOwner(): void
    {
        self::assertSame($this->owner, $this->sut->getOwner());
    }

    public function testIsPrivate(): void
    {
        self::assertSame($this->private, $this->sut->isPrivate());
    }

    public function testGetDefaultBranch(): void
    {
        self::assertSame($this->defaultBranch, $this->sut->getDefaultBranch());
    }

    public function testIsFork(): void
    {
        self::assertSame($this->fork, $this->sut->isFork());
    }

    public function testGetParent(): void
    {
        self::assertSame($this->parent, $this->sut->getParent());
    }

    public function testGetDescription(): void
    {
        self::assertSame($this->description, $this->sut->getDescription());
    }

    public function testGetHomepage(): void
    {
        self::assertSame($this->homepage, $this->sut->getHomepage());
    }

    public function testGetLanguage(): void
    {
        self::assertSame($this->language, $this->sut->getLanguage());
    }

    public function testGetMirrorUrl(): void
    {
        self::assertSame($this->mirrorUrl, $this->sut->getMirrorUrl());
    }

    public function testIsArchived(): void
    {
        self::assertSame($this->archived, $this->sut->isArchived());
    }

    public function testGetEndpoints(): void
    {
        self::assertSame($this->endpoints, $this->sut->getEndpoints());
    }

    public function testGetStats(): void
    {
        self::assertSame($this->stats, $this->sut->getStats());
    }

    public function testGetTimestamps(): void
    {
        self::assertSame($this->timestamps, $this->sut->getTimestamps());
    }

    public function testGetAdditionalDetails(): void
    {
        self::assertSame($this->additionalDetails, $this->sut->getAdditionalDetails());
    }

    public function testGetRepoAdditionalUrls(): void
    {
        self::assertSame($this->repoAdditionalUrls, $this->sut->getRepoAdditionalUrls());
    }

    public function testHasParent(): void
    {
        self::assertTrue($this->sut->hasParent());
    }

    public function testHasDescription(): void
    {
        self::assertTrue($this->sut->hasDescription());
    }

    public function testHasHomepage(): void
    {
        self::assertTrue($this->sut->hasHomepage());
    }

    public function testHasLanguage(): void
    {
        self::assertTrue($this->sut->hasLanguage());
    }

    public function testHasMirrorUrl(): void
    {
        self::assertTrue($this->sut->hasMirrorUrl());
    }

    public function testHasArchived(): void
    {
        self::assertTrue($this->sut->hasArchived());
    }

    public function testSerialize(): void
    {
        $expected = [
            'id'            => 64778136,
            'fullName'      => ['owner' => 'value', 'repoName' => 'name'],
            'owner'         => RepoOwnerSample::serialized('octocat'),
            'private'       => false,
            'defaultBranch' => 'master',
            'fork'          => false,
            'parent'        => ['id' => 1, 'fullName' => ['owner' => 'value', 'repoName' => 'name']],
            'description'   => 'Language Savant. If your repository language is being reported incorrectly, send us a pull request!',
            'homepage'      => 'http://www.example.com/',
            'language'      => 'PHP',
            'mirrorUrl'     => 'http://mirror.example.com',
            'archived'      => false,
            'endpoints'     => ['htmlUrl' => 'htmlUrl', 'apiUrl' => 'apiUrl', 'gitUrl' => 'gitUrl', 'sshUrl' => 'sshUrl'],
            'stats'         => [
                'networkCount'     => 1,
                'watchersCount'    => 1,
                'stargazersCount'  => 1,
                'subscribersCount' => 1,
                'openIssuesCount'  => 1,
                'size'             => 1,
            ],
            'timestamps' => [
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
                'pushedAt'  => '2018-01-01T00:01:00+00:00',
            ],
            'additionalDetails' => [
                'license'      => 'master',
                'forksCount'   => 0,
                'hasDownloads' => true,
                'hasIssues'    => true,
                'hasPages'     => true,
                'hasProjects'  => true,
                'hasWiki'      => true,
            ],
            'repoAdditionalUrls' => RepoAdditionalUrlsTest::provideSerializedExample(),
        ];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, Repo::deserialize(json_decode($serialized, true)));
    }
}
