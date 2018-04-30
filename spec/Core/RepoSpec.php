<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core;

use DevboardLib\Git\Branch\BranchName;
use DevboardLib\GitHub\Repo\RepoDescription;
use DevboardLib\GitHub\Repo\RepoEndpoints;
use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoHomepage;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHub\Repo\RepoLanguage;
use DevboardLib\GitHub\Repo\RepoMirrorUrl;
use DevboardLib\GitHub\Repo\RepoParent;
use DevboardLib\GitHub\Repo\RepoStats;
use DevboardLib\GitHub\Repo\RepoTimestamps;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\RepoAdditionalDetails;
use DevboardLib\GitHubWebhook\Core\RepoAdditionalUrls;
use DevboardLib\GitHubWebhook\Core\RepoOwner;
use PhpSpec\ObjectBehavior;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 */
class RepoSpec extends ObjectBehavior
{
    public function let(
        RepoId $id,
        RepoFullName $fullName,
        RepoOwner $owner,
        BranchName $defaultBranch,
        RepoParent $parent,
        RepoDescription $description,
        RepoHomepage $homepage,
        RepoLanguage $language,
        RepoMirrorUrl $mirrorUrl,
        RepoEndpoints $endpoints,
        RepoStats $stats,
        RepoTimestamps $timestamps,
        RepoAdditionalDetails $additionalDetails,
        RepoAdditionalUrls $repoAdditionalUrls
    ) {
        $this->beConstructedWith(
            $id,
            $fullName,
            $owner,
            $private = false,
            $defaultBranch,
            $fork = false,
            $parent,
            $description,
            $homepage,
            $language,
            $mirrorUrl,
            $archived = false,
            $endpoints,
            $stats,
            $timestamps,
            $additionalDetails,
            $repoAdditionalUrls
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Repo::class);
    }

    public function it_exposes_id(RepoId $id)
    {
        $this->getId()->shouldReturn($id);
    }

    public function it_exposes_full_name(RepoFullName $fullName)
    {
        $this->getFullName()->shouldReturn($fullName);
    }

    public function it_exposes_owner(RepoOwner $owner)
    {
        $this->getOwner()->shouldReturn($owner);
    }

    public function it_exposes_is_private()
    {
        $this->isPrivate()->shouldReturn(false);
    }

    public function it_exposes_default_branch(BranchName $defaultBranch)
    {
        $this->getDefaultBranch()->shouldReturn($defaultBranch);
    }

    public function it_exposes_is_fork()
    {
        $this->isFork()->shouldReturn(false);
    }

    public function it_exposes_parent(RepoParent $parent)
    {
        $this->getParent()->shouldReturn($parent);
    }

    public function it_exposes_description(RepoDescription $description)
    {
        $this->getDescription()->shouldReturn($description);
    }

    public function it_exposes_homepage(RepoHomepage $homepage)
    {
        $this->getHomepage()->shouldReturn($homepage);
    }

    public function it_exposes_language(RepoLanguage $language)
    {
        $this->getLanguage()->shouldReturn($language);
    }

    public function it_exposes_mirror_url(RepoMirrorUrl $mirrorUrl)
    {
        $this->getMirrorUrl()->shouldReturn($mirrorUrl);
    }

    public function it_exposes_is_archived()
    {
        $this->isArchived()->shouldReturn(false);
    }

    public function it_exposes_endpoints(RepoEndpoints $endpoints)
    {
        $this->getEndpoints()->shouldReturn($endpoints);
    }

    public function it_exposes_stats(RepoStats $stats)
    {
        $this->getStats()->shouldReturn($stats);
    }

    public function it_exposes_timestamps(RepoTimestamps $timestamps)
    {
        $this->getTimestamps()->shouldReturn($timestamps);
    }

    public function it_exposes_additional_details(RepoAdditionalDetails $additionalDetails)
    {
        $this->getAdditionalDetails()->shouldReturn($additionalDetails);
    }

    public function it_exposes_repo_additional_urls(RepoAdditionalUrls $repoAdditionalUrls)
    {
        $this->getRepoAdditionalUrls()->shouldReturn($repoAdditionalUrls);
    }

    public function it_has_parent()
    {
        $this->hasParent()->shouldReturn(true);
    }

    public function it_has_description()
    {
        $this->hasDescription()->shouldReturn(true);
    }

    public function it_has_homepage()
    {
        $this->hasHomepage()->shouldReturn(true);
    }

    public function it_has_language()
    {
        $this->hasLanguage()->shouldReturn(true);
    }

    public function it_has_mirror_url()
    {
        $this->hasMirrorUrl()->shouldReturn(true);
    }

    public function it_has_archived()
    {
        $this->hasArchived()->shouldReturn(true);
    }

    public function it_can_be_serialized(
        RepoId $id,
        RepoFullName $fullName,
        RepoOwner $owner,
        BranchName $defaultBranch,
        RepoParent $parent,
        RepoDescription $description,
        RepoHomepage $homepage,
        RepoLanguage $language,
        RepoMirrorUrl $mirrorUrl,
        RepoEndpoints $endpoints,
        RepoStats $stats,
        RepoTimestamps $timestamps,
        RepoAdditionalDetails $additionalDetails,
        RepoAdditionalUrls $repoAdditionalUrls
    ) {
        $id->serialize()->shouldBeCalled()->willReturn(64778136);
        $fullName->serialize()->shouldBeCalled()->willReturn(['owner' => 'value', 'repoName' => 'name']);
        $owner->serialize()->shouldBeCalled()->willReturn(
            [
                'userId'            => 1,
                'login'             => 'value',
                'type'              => 'User',
                'avatarUrl'         => 'avatarUrl',
                'siteAdmin'         => true,
                'name'              => 'name',
                'email'             => 'email',
                'eventsUrl'         => 'eventsUrl',
                'followersUrl'      => 'followersUrl',
                'followingUrl'      => 'followingUrl',
                'gistsUrl'          => 'gistsUrl',
                'organizationsUrl'  => 'organizationsUrl',
                'receivedEventsUrl' => 'receivedEventsUrl',
                'reposUrl'          => 'reposUrl',
                'starredUrl'        => 'starredUrl',
                'subscriptionsUrl'  => 'subscriptionsUrl',
            ]
        );
        $defaultBranch->serialize()->shouldBeCalled()->willReturn('master');
        $parent->serialize()->shouldBeCalled()->willReturn(
            ['id' => 1, 'fullName' => ['owner' => 'value', 'repoName' => 'name']]
        );
        $description->serialize()->shouldBeCalled()->willReturn(
            'Language Savant. If your repository language is being reported incorrectly, send us a pull request!'
        );
        $homepage->serialize()->shouldBeCalled()->willReturn('http://www.example.com/');
        $language->serialize()->shouldBeCalled()->willReturn('PHP');
        $mirrorUrl->serialize()->shouldBeCalled()->willReturn('http://mirror.example.com');
        $endpoints->serialize()->shouldBeCalled()->willReturn(
            ['htmlUrl' => 'htmlUrl', 'apiUrl' => 'apiUrl', 'gitUrl' => 'gitUrl', 'sshUrl' => 'sshUrl']
        );
        $stats->serialize()->shouldBeCalled()->willReturn(
            [
                'networkCount'     => 1,
                'watchersCount'    => 1,
                'stargazersCount'  => 1,
                'subscribersCount' => 1,
                'openIssuesCount'  => 1,
                'size'             => 1,
            ]
        );
        $timestamps->serialize()->shouldBeCalled()->willReturn(
            [
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
                'pushedAt'  => '2018-01-01T00:01:00+00:00',
            ]
        );
        $additionalDetails->serialize()->shouldBeCalled()->willReturn(
            [
                'license'      => 'master',
                'forksCount'   => 0,
                'hasDownloads' => true,
                'hasIssues'    => true,
                'hasPages'     => true,
                'hasProjects'  => true,
                'hasWiki'      => true,
            ]
        );
        $repoAdditionalUrls->serialize()->shouldBeCalled()->willReturn(
            [
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
            ]
        );
        $this->serialize()->shouldReturn(
            [
                'id'       => 64778136,
                'fullName' => ['owner' => 'value', 'repoName' => 'name'],
                'owner'    => [
                    'userId'            => 1,
                    'login'             => 'value',
                    'type'              => 'User',
                    'avatarUrl'         => 'avatarUrl',
                    'siteAdmin'         => true,
                    'name'              => 'name',
                    'email'             => 'email',
                    'eventsUrl'         => 'eventsUrl',
                    'followersUrl'      => 'followersUrl',
                    'followingUrl'      => 'followingUrl',
                    'gistsUrl'          => 'gistsUrl',
                    'organizationsUrl'  => 'organizationsUrl',
                    'receivedEventsUrl' => 'receivedEventsUrl',
                    'reposUrl'          => 'reposUrl',
                    'starredUrl'        => 'starredUrl',
                    'subscriptionsUrl'  => 'subscriptionsUrl',
                ],
                'private'       => false,
                'defaultBranch' => 'master',
                'fork'          => false,
                'parent'        => ['id' => 1, 'fullName' => ['owner' => 'value', 'repoName' => 'name']],
                'description'   => 'Language Savant. If your repository language is being reported incorrectly, send us a pull request!',
                'homepage'      => 'http://www.example.com/',
                'language'      => 'PHP',
                'mirrorUrl'     => 'http://mirror.example.com',
                'archived'      => false,
                'endpoints'     => [
                    'htmlUrl' => 'htmlUrl',
                    'apiUrl'  => 'apiUrl',
                    'gitUrl'  => 'gitUrl',
                    'sshUrl'  => 'sshUrl',
                ],
                'stats' => [
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
                'repoAdditionalUrls' => [
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
                ],
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'id'       => 64778136,
            'fullName' => ['owner' => 'value', 'repoName' => 'name'],
            'owner'    => [
                'userId'            => 1,
                'login'             => 'value',
                'type'              => 'User',
                'avatarUrl'         => 'avatarUrl',
                'siteAdmin'         => true,
                'name'              => 'name',
                'email'             => 'email',
                'eventsUrl'         => 'eventsUrl',
                'followersUrl'      => 'followersUrl',
                'followingUrl'      => 'followingUrl',
                'gistsUrl'          => 'gistsUrl',
                'organizationsUrl'  => 'organizationsUrl',
                'receivedEventsUrl' => 'receivedEventsUrl',
                'reposUrl'          => 'reposUrl',
                'starredUrl'        => 'starredUrl',
                'subscriptionsUrl'  => 'subscriptionsUrl',
            ],
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
            'repoAdditionalUrls' => [
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
            ],
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(Repo::class);
    }
}
