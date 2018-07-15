<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\RepoAdditionalUrls;
use PHPUnit\Framework\TestCase;

/**
 * @SuppressWarnings(PHPMD.TooManyFields)
 * @SuppressWarnings(PHPMD.TooManyMethods)
 * @covers \DevboardLib\GitHubWebhook\Core\RepoAdditionalUrls
 * @group  unit
 */
class RepoAdditionalUrlsTest extends TestCase
{
    /** @var string */
    private $archiveUrl;

    /** @var string */
    private $assigneesUrl;

    /** @var string */
    private $blobsUrl;

    /** @var string */
    private $branchesUrl;

    /** @var string */
    private $cloneUrl;

    /** @var string */
    private $collaboratorsUrl;

    /** @var string */
    private $commentsUrl;

    /** @var string */
    private $commitsUrl;

    /** @var string */
    private $compareUrl;

    /** @var string */
    private $contentsUrl;

    /** @var string */
    private $contributorsUrl;

    /** @var string */
    private $deploymentsUrl;

    /** @var string */
    private $downloadsUrl;

    /** @var string */
    private $eventsUrl;

    /** @var string */
    private $forksUrl;

    /** @var string */
    private $gitCommitsUrl;

    /** @var string */
    private $gitRefsUrl;

    /** @var string */
    private $gitTagsUrl;

    /** @var string */
    private $hooksUrl;

    /** @var string */
    private $issueCommentUrl;

    /** @var string */
    private $issueEventsUrl;

    /** @var string */
    private $issuesUrl;

    /** @var string */
    private $keysUrl;

    /** @var string */
    private $labelsUrl;

    /** @var string */
    private $languagesUrl;

    /** @var string */
    private $mergesUrl;

    /** @var string */
    private $milestonesUrl;

    /** @var string */
    private $notificationsUrl;

    /** @var string */
    private $pullsUrl;

    /** @var string */
    private $releasesUrl;

    /** @var string */
    private $stargazersUrl;

    /** @var string */
    private $statusesUrl;

    /** @var string */
    private $subscribersUrl;

    /** @var string */
    private $subscriptionUrl;

    /** @var string */
    private $tagsUrl;

    /** @var string */
    private $teamsUrl;

    /** @var string */
    private $treesUrl;

    /** @var string */
    private $svnUrl;

    /** @var RepoAdditionalUrls */
    private $sut;

    public function setUp(): void
    {
        $this->archiveUrl       = 'https://api.github.com/repos/octocat/linguist/{archive_format}{/ref}';
        $this->assigneesUrl     = 'https://api.github.com/repos/octocat/linguist/assignees{/user}';
        $this->blobsUrl         = 'https://api.github.com/repos/octocat/linguist/git/blobs{/sha}';
        $this->branchesUrl      = 'https://api.github.com/repos/octocat/linguist/branches{/branch}';
        $this->cloneUrl         = 'https://github.com/octocat/linguist.git';
        $this->collaboratorsUrl = 'https://api.github.com/repos/octocat/linguist/collaborators{/collaborator}';
        $this->commentsUrl      = 'https://api.github.com/repos/octocat/linguist/comments{/number}';
        $this->commitsUrl       = 'https://api.github.com/repos/octocat/linguist/commits{/sha}';
        $this->compareUrl       = 'https://api.github.com/repos/octocat/linguist/compare/{base}...{head}';
        $this->contentsUrl      = 'https://api.github.com/repos/octocat/linguist/contents/{+path}';
        $this->contributorsUrl  = 'https://api.github.com/repos/octocat/linguist/contributors';
        $this->deploymentsUrl   = 'https://api.github.com/repos/octocat/linguist/deployments';
        $this->downloadsUrl     = 'https://api.github.com/repos/octocat/linguist/downloads';
        $this->eventsUrl        = 'https://api.github.com/repos/octocat/linguist/events';
        $this->forksUrl         = 'https://api.github.com/repos/octocat/linguist/forks';
        $this->gitCommitsUrl    = 'https://api.github.com/repos/octocat/linguist/git/commits{/sha}';
        $this->gitRefsUrl       = 'https://api.github.com/repos/octocat/linguist/git/refs{/sha}';
        $this->gitTagsUrl       = 'https://api.github.com/repos/octocat/linguist/git/tags{/sha}';
        $this->hooksUrl         = 'https://api.github.com/repos/octocat/linguist/hooks';
        $this->issueCommentUrl  = 'https://api.github.com/repos/octocat/linguist/issues/comments{/number}';
        $this->issueEventsUrl   = 'https://api.github.com/repos/octocat/linguist/issues/events{/number}';
        $this->issuesUrl        = 'https://api.github.com/repos/octocat/linguist/issues{/number}';
        $this->keysUrl          = 'https://api.github.com/repos/octocat/linguist/keys{/key_id}';
        $this->labelsUrl        = 'https://api.github.com/repos/octocat/linguist/labels{/name}';
        $this->languagesUrl     = 'https://api.github.com/repos/octocat/linguist/languages';
        $this->mergesUrl        = 'https://api.github.com/repos/octocat/linguist/merges';
        $this->milestonesUrl    = 'https://api.github.com/repos/octocat/linguist/milestones{/number}';
        $this->notificationsUrl = 'https://api.github.com/repos/octocat/linguist/notifications{?since,all,participating}';
        $this->pullsUrl         = 'https://api.github.com/repos/octocat/linguist/pulls{/number}';
        $this->releasesUrl      = 'https://api.github.com/repos/octocat/linguist/releases{/id}';
        $this->stargazersUrl    = 'https://api.github.com/repos/octocat/linguist/stargazers';
        $this->statusesUrl      = 'https://api.github.com/repos/octocat/linguist/statuses/{sha}';
        $this->subscribersUrl   = 'https://api.github.com/repos/octocat/linguist/subscribers';
        $this->subscriptionUrl  = 'https://api.github.com/repos/octocat/linguist/subscription';
        $this->tagsUrl          = 'https://api.github.com/repos/octocat/linguist/tags';
        $this->teamsUrl         = 'https://api.github.com/repos/octocat/linguist/teams';
        $this->treesUrl         = 'https://api.github.com/repos/octocat/linguist/git/trees{/sha}';
        $this->svnUrl           = 'https://github.com/octocat/linguist';
        $this->sut              = new RepoAdditionalUrls(
            $this->archiveUrl,
            $this->assigneesUrl,
            $this->blobsUrl,
            $this->branchesUrl,
            $this->cloneUrl,
            $this->collaboratorsUrl,
            $this->commentsUrl,
            $this->commitsUrl,
            $this->compareUrl,
            $this->contentsUrl,
            $this->contributorsUrl,
            $this->deploymentsUrl,
            $this->downloadsUrl,
            $this->eventsUrl,
            $this->forksUrl,
            $this->gitCommitsUrl,
            $this->gitRefsUrl,
            $this->gitTagsUrl,
            $this->hooksUrl,
            $this->issueCommentUrl,
            $this->issueEventsUrl,
            $this->issuesUrl,
            $this->keysUrl,
            $this->labelsUrl,
            $this->languagesUrl,
            $this->mergesUrl,
            $this->milestonesUrl,
            $this->notificationsUrl,
            $this->pullsUrl,
            $this->releasesUrl,
            $this->stargazersUrl,
            $this->statusesUrl,
            $this->subscribersUrl,
            $this->subscriptionUrl,
            $this->tagsUrl,
            $this->teamsUrl,
            $this->treesUrl,
            $this->svnUrl
        );
    }

    public function testGetArchiveUrl(): void
    {
        self::assertSame($this->archiveUrl, $this->sut->getArchiveUrl());
    }

    public function testGetAssigneesUrl(): void
    {
        self::assertSame($this->assigneesUrl, $this->sut->getAssigneesUrl());
    }

    public function testGetBlobsUrl(): void
    {
        self::assertSame($this->blobsUrl, $this->sut->getBlobsUrl());
    }

    public function testGetBranchesUrl(): void
    {
        self::assertSame($this->branchesUrl, $this->sut->getBranchesUrl());
    }

    public function testGetCloneUrl(): void
    {
        self::assertSame($this->cloneUrl, $this->sut->getCloneUrl());
    }

    public function testGetCollaboratorsUrl(): void
    {
        self::assertSame($this->collaboratorsUrl, $this->sut->getCollaboratorsUrl());
    }

    public function testGetCommentsUrl(): void
    {
        self::assertSame($this->commentsUrl, $this->sut->getCommentsUrl());
    }

    public function testGetCommitsUrl(): void
    {
        self::assertSame($this->commitsUrl, $this->sut->getCommitsUrl());
    }

    public function testGetCompareUrl(): void
    {
        self::assertSame($this->compareUrl, $this->sut->getCompareUrl());
    }

    public function testGetContentsUrl(): void
    {
        self::assertSame($this->contentsUrl, $this->sut->getContentsUrl());
    }

    public function testGetContributorsUrl(): void
    {
        self::assertSame($this->contributorsUrl, $this->sut->getContributorsUrl());
    }

    public function testGetDeploymentsUrl(): void
    {
        self::assertSame($this->deploymentsUrl, $this->sut->getDeploymentsUrl());
    }

    public function testGetDownloadsUrl(): void
    {
        self::assertSame($this->downloadsUrl, $this->sut->getDownloadsUrl());
    }

    public function testGetEventsUrl(): void
    {
        self::assertSame($this->eventsUrl, $this->sut->getEventsUrl());
    }

    public function testGetForksUrl(): void
    {
        self::assertSame($this->forksUrl, $this->sut->getForksUrl());
    }

    public function testGetGitCommitsUrl(): void
    {
        self::assertSame($this->gitCommitsUrl, $this->sut->getGitCommitsUrl());
    }

    public function testGetGitRefsUrl(): void
    {
        self::assertSame($this->gitRefsUrl, $this->sut->getGitRefsUrl());
    }

    public function testGetGitTagsUrl(): void
    {
        self::assertSame($this->gitTagsUrl, $this->sut->getGitTagsUrl());
    }

    public function testGetHooksUrl(): void
    {
        self::assertSame($this->hooksUrl, $this->sut->getHooksUrl());
    }

    public function testGetIssueCommentUrl(): void
    {
        self::assertSame($this->issueCommentUrl, $this->sut->getIssueCommentUrl());
    }

    public function testGetIssueEventsUrl(): void
    {
        self::assertSame($this->issueEventsUrl, $this->sut->getIssueEventsUrl());
    }

    public function testGetIssuesUrl(): void
    {
        self::assertSame($this->issuesUrl, $this->sut->getIssuesUrl());
    }

    public function testGetKeysUrl(): void
    {
        self::assertSame($this->keysUrl, $this->sut->getKeysUrl());
    }

    public function testGetLabelsUrl(): void
    {
        self::assertSame($this->labelsUrl, $this->sut->getLabelsUrl());
    }

    public function testGetLanguagesUrl(): void
    {
        self::assertSame($this->languagesUrl, $this->sut->getLanguagesUrl());
    }

    public function testGetMergesUrl(): void
    {
        self::assertSame($this->mergesUrl, $this->sut->getMergesUrl());
    }

    public function testGetMilestonesUrl(): void
    {
        self::assertSame($this->milestonesUrl, $this->sut->getMilestonesUrl());
    }

    public function testGetNotificationsUrl(): void
    {
        self::assertSame($this->notificationsUrl, $this->sut->getNotificationsUrl());
    }

    public function testGetPullsUrl(): void
    {
        self::assertSame($this->pullsUrl, $this->sut->getPullsUrl());
    }

    public function testGetReleasesUrl(): void
    {
        self::assertSame($this->releasesUrl, $this->sut->getReleasesUrl());
    }

    public function testGetStargazersUrl(): void
    {
        self::assertSame($this->stargazersUrl, $this->sut->getStargazersUrl());
    }

    public function testGetStatusesUrl(): void
    {
        self::assertSame($this->statusesUrl, $this->sut->getStatusesUrl());
    }

    public function testGetSubscribersUrl(): void
    {
        self::assertSame($this->subscribersUrl, $this->sut->getSubscribersUrl());
    }

    public function testGetSubscriptionUrl(): void
    {
        self::assertSame($this->subscriptionUrl, $this->sut->getSubscriptionUrl());
    }

    public function testGetTagsUrl(): void
    {
        self::assertSame($this->tagsUrl, $this->sut->getTagsUrl());
    }

    public function testGetTeamsUrl(): void
    {
        self::assertSame($this->teamsUrl, $this->sut->getTeamsUrl());
    }

    public function testGetTreesUrl(): void
    {
        self::assertSame($this->treesUrl, $this->sut->getTreesUrl());
    }

    public function testGetSvnUrl(): void
    {
        self::assertSame($this->svnUrl, $this->sut->getSvnUrl());
    }

    public function testSerialize(): void
    {
        $expected = self::provideSerializedExample();

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize(): void
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, RepoAdditionalUrls::deserialize(json_decode($serialized, true)));
    }

    public static function provideSerializedExample(): array
    {
        return [
            'archiveUrl'       => 'https://api.github.com/repos/octocat/linguist/{archive_format}{/ref}',
            'assigneesUrl'     => 'https://api.github.com/repos/octocat/linguist/assignees{/user}',
            'blobsUrl'         => 'https://api.github.com/repos/octocat/linguist/git/blobs{/sha}',
            'branchesUrl'      => 'https://api.github.com/repos/octocat/linguist/branches{/branch}',
            'cloneUrl'         => 'https://github.com/octocat/linguist.git',
            'collaboratorsUrl' => 'https://api.github.com/repos/octocat/linguist/collaborators{/collaborator}',
            'commentsUrl'      => 'https://api.github.com/repos/octocat/linguist/comments{/number}',
            'commitsUrl'       => 'https://api.github.com/repos/octocat/linguist/commits{/sha}',
            'compareUrl'       => 'https://api.github.com/repos/octocat/linguist/compare/{base}...{head}',
            'contentsUrl'      => 'https://api.github.com/repos/octocat/linguist/contents/{+path}',
            'contributorsUrl'  => 'https://api.github.com/repos/octocat/linguist/contributors',
            'deploymentsUrl'   => 'https://api.github.com/repos/octocat/linguist/deployments',
            'downloadsUrl'     => 'https://api.github.com/repos/octocat/linguist/downloads',
            'eventsUrl'        => 'https://api.github.com/repos/octocat/linguist/events',
            'forksUrl'         => 'https://api.github.com/repos/octocat/linguist/forks',
            'gitCommitsUrl'    => 'https://api.github.com/repos/octocat/linguist/git/commits{/sha}',
            'gitRefsUrl'       => 'https://api.github.com/repos/octocat/linguist/git/refs{/sha}',
            'gitTagsUrl'       => 'https://api.github.com/repos/octocat/linguist/git/tags{/sha}',
            'hooksUrl'         => 'https://api.github.com/repos/octocat/linguist/hooks',
            'issueCommentUrl'  => 'https://api.github.com/repos/octocat/linguist/issues/comments{/number}',
            'issueEventsUrl'   => 'https://api.github.com/repos/octocat/linguist/issues/events{/number}',
            'issuesUrl'        => 'https://api.github.com/repos/octocat/linguist/issues{/number}',
            'keysUrl'          => 'https://api.github.com/repos/octocat/linguist/keys{/key_id}',
            'labelsUrl'        => 'https://api.github.com/repos/octocat/linguist/labels{/name}',
            'languagesUrl'     => 'https://api.github.com/repos/octocat/linguist/languages',
            'mergesUrl'        => 'https://api.github.com/repos/octocat/linguist/merges',
            'milestonesUrl'    => 'https://api.github.com/repos/octocat/linguist/milestones{/number}',
            'notificationsUrl' => 'https://api.github.com/repos/octocat/linguist/notifications{?since,all,participating}',
            'pullsUrl'         => 'https://api.github.com/repos/octocat/linguist/pulls{/number}',
            'releasesUrl'      => 'https://api.github.com/repos/octocat/linguist/releases{/id}',
            'stargazersUrl'    => 'https://api.github.com/repos/octocat/linguist/stargazers',
            'statusesUrl'      => 'https://api.github.com/repos/octocat/linguist/statuses/{sha}',
            'subscribersUrl'   => 'https://api.github.com/repos/octocat/linguist/subscribers',
            'subscriptionUrl'  => 'https://api.github.com/repos/octocat/linguist/subscription',
            'tagsUrl'          => 'https://api.github.com/repos/octocat/linguist/tags',
            'teamsUrl'         => 'https://api.github.com/repos/octocat/linguist/teams',
            'treesUrl'         => 'https://api.github.com/repos/octocat/linguist/git/trees{/sha}',
            'svnUrl'           => 'https://github.com/octocat/linguist',
        ];
    }

    public static function provideExample(): RepoAdditionalUrls
    {
        return new RepoAdditionalUrls(
            'https://api.github.com/repos/octocat/linguist/{archive_format}{/ref}',
            'https://api.github.com/repos/octocat/linguist/assignees{/user}',
            'https://api.github.com/repos/octocat/linguist/git/blobs{/sha}',
            'https://api.github.com/repos/octocat/linguist/branches{/branch}',
            'https://github.com/octocat/linguist.git',
            'https://api.github.com/repos/octocat/linguist/collaborators{/collaborator}',
            'https://api.github.com/repos/octocat/linguist/comments{/number}',
            'https://api.github.com/repos/octocat/linguist/commits{/sha}',
            'https://api.github.com/repos/octocat/linguist/compare/{base}...{head}',
            'https://api.github.com/repos/octocat/linguist/contents/{+path}',
            'https://api.github.com/repos/octocat/linguist/contributors',
            'https://api.github.com/repos/octocat/linguist/deployments',
            'https://api.github.com/repos/octocat/linguist/downloads',
            'https://api.github.com/repos/octocat/linguist/events',
            'https://api.github.com/repos/octocat/linguist/forks',
            'https://api.github.com/repos/octocat/linguist/git/commits{/sha}',
            'https://api.github.com/repos/octocat/linguist/git/refs{/sha}',
            'https://api.github.com/repos/octocat/linguist/git/tags{/sha}',
            'https://api.github.com/repos/octocat/linguist/hooks',
            'https://api.github.com/repos/octocat/linguist/issues/comments{/number}',
            'https://api.github.com/repos/octocat/linguist/issues/events{/number}',
            'https://api.github.com/repos/octocat/linguist/issues{/number}',
            'https://api.github.com/repos/octocat/linguist/keys{/key_id}',
            'https://api.github.com/repos/octocat/linguist/labels{/name}',
            'https://api.github.com/repos/octocat/linguist/languages',
            'https://api.github.com/repos/octocat/linguist/merges',
            'https://api.github.com/repos/octocat/linguist/milestones{/number}',
            'https://api.github.com/repos/octocat/linguist/notifications{?since,all,participating}',
            'https://api.github.com/repos/octocat/linguist/pulls{/number}',
            'https://api.github.com/repos/octocat/linguist/releases{/id}',
            'https://api.github.com/repos/octocat/linguist/stargazers',
            'https://api.github.com/repos/octocat/linguist/statuses/{sha}',
            'https://api.github.com/repos/octocat/linguist/subscribers',
            'https://api.github.com/repos/octocat/linguist/subscription',
            'https://api.github.com/repos/octocat/linguist/tags',
            'https://api.github.com/repos/octocat/linguist/teams',
            'https://api.github.com/repos/octocat/linguist/git/trees{/sha}',
            'https://github.com/octocat/linguist'
        );
    }
}
