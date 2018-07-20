<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Hook\Status;

use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHubWebhook\Core\GitHubStatusCheck;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Core\Status\BranchNameCollection;
use DevboardLib\GitHubWebhook\Core\Status\Commit;
use DevboardLib\GitHubWebhook\Hook\GitHubHookEvent;
use DevboardLib\GitHubWebhook\Hook\RepositoryRelatedEvent;
use DevboardLib\GitHubWebhook\Hook\Status\StatusEvent;
use PhpSpec\ObjectBehavior;

class StatusEventSpec extends ObjectBehavior
{
    public function let(
        GitHubStatusCheck $status, Commit $commit, Repo $repo, BranchNameCollection $branches, Sender $sender
    ) {
        $this->beConstructedWith($status, $commit, $repo, $branches, $sender);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(StatusEvent::class);
        $this->shouldImplement(GitHubHookEvent::class);
        $this->shouldImplement(RepositoryRelatedEvent::class);
    }

    public function it_exposes_status(GitHubStatusCheck $status)
    {
        $this->getStatus()->shouldReturn($status);
    }

    public function it_exposes_commit(Commit $commit)
    {
        $this->getCommit()->shouldReturn($commit);
    }

    public function it_exposes_repo(Repo $repo)
    {
        $this->getRepo()->shouldReturn($repo);
    }

    public function it_exposes_branches(BranchNameCollection $branches)
    {
        $this->getBranches()->shouldReturn($branches);
    }

    public function it_exposes_sender(Sender $sender)
    {
        $this->getSender()->shouldReturn($sender);
    }

    public function it_can_be_serialized(
        GitHubStatusCheck $status, Commit $commit, Repo $repo, BranchNameCollection $branches, Sender $sender
    ) {
        $status->serialize()->shouldBeCalled()->willReturn(
            [
                'id'              => 1,
                'state'           => 'pending',
                'description'     => 'value',
                'targetUrl'       => 'targetUrl',
                'context'         => 'description',
                'externalService' => [
                    'context'   => 'ci/circleci',
                    'className' => 'DevboardLib\GitHub\External\Service\ContinuousIntegration\CircleCi',
                ],
                'creator' => [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ]
        );
        $commit->serialize()->shouldBeCalled()->willReturn(
            [
                'sha'        => 'sha',
                'message'    => 'message',
                'commitDate' => '2018-01-01T00:01:00+00:00',
                'author'     => [
                    'name'      => 'name',
                    'email'     => 'octocat@example.com',
                    'createdAt' => '2018-01-01T00:01:00+00:00',
                    'details'   => [
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
                ],
                'committer' => [
                    'name'        => 'name',
                    'email'       => 'octocat@example.com',
                    'committedAt' => '2018-01-01T00:01:00+00:00',
                    'details'     => [
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
                ],
                'tree'         => ['sha' => 'sha', 'apiUrl' => 'url'],
                'parents'      => [['sha' => 'sha', 'apiUrl' => 'apiUrl', 'htmlUrl' => 'htmlUrl']],
                'verification' => [
                    'verified'  => true,
                    'reason'    => 'reason',
                    'signature' => 'signature',
                    'payload'   => 'payload',
                ],
                'apiUrl'      => 'apiUrl',
                'htmlUrl'     => 'htmlUrl',
                'commentsUrl' => 'commentsUrl',
            ]
        );
        $repo->serialize()->shouldBeCalled()->willReturn(
            [
                'id'       => 1,
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
                'private'       => true,
                'defaultBranch' => 'name',
                'fork'          => true,
                'parent'        => ['id' => 1, 'fullName' => ['owner' => 'value', 'repoName' => 'name']],
                'description'   => 'description',
                'homepage'      => 'homepage',
                'language'      => 'language',
                'mirrorUrl'     => 'mirrorUrl',
                'archived'      => true,
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
        $branches->serialize()->shouldBeCalled()->willReturn(['name']);
        $sender->serialize()->shouldBeCalled()->willReturn(SenderSample::serialized('octocat'));
        $this->serialize()->shouldReturn(
            [
                'status' => [
                    'id'              => 1,
                    'state'           => 'pending',
                    'description'     => 'value',
                    'targetUrl'       => 'targetUrl',
                    'context'         => 'description',
                    'externalService' => [
                        'context'   => 'ci/circleci',
                        'className' => 'DevboardLib\GitHub\External\Service\ContinuousIntegration\CircleCi',
                    ],
                    'creator' => [
                        'userId'    => 1,
                        'login'     => 'value',
                        'type'      => 'User',
                        'avatarUrl' => 'avatarUrl',
                        'siteAdmin' => true,
                    ],
                    'createdAt' => '2018-01-01T00:01:00+00:00',
                    'updatedAt' => '2018-01-01T00:01:00+00:00',
                ],
                'commit' => [
                    'sha'        => 'sha',
                    'message'    => 'message',
                    'commitDate' => '2018-01-01T00:01:00+00:00',
                    'author'     => [
                        'name'      => 'name',
                        'email'     => 'octocat@example.com',
                        'createdAt' => '2018-01-01T00:01:00+00:00',
                        'details'   => [
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
                    ],
                    'committer' => [
                        'name'        => 'name',
                        'email'       => 'octocat@example.com',
                        'committedAt' => '2018-01-01T00:01:00+00:00',
                        'details'     => [
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
                    ],
                    'tree'         => ['sha' => 'sha', 'apiUrl' => 'url'],
                    'parents'      => [['sha' => 'sha', 'apiUrl' => 'apiUrl', 'htmlUrl' => 'htmlUrl']],
                    'verification' => [
                        'verified'  => true,
                        'reason'    => 'reason',
                        'signature' => 'signature',
                        'payload'   => 'payload',
                    ],
                    'apiUrl'      => 'apiUrl',
                    'htmlUrl'     => 'htmlUrl',
                    'commentsUrl' => 'commentsUrl',
                ],
                'repo' => [
                    'id'       => 1,
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
                    'private'       => true,
                    'defaultBranch' => 'name',
                    'fork'          => true,
                    'parent'        => ['id' => 1, 'fullName' => ['owner' => 'value', 'repoName' => 'name']],
                    'description'   => 'description',
                    'homepage'      => 'homepage',
                    'language'      => 'language',
                    'mirrorUrl'     => 'mirrorUrl',
                    'archived'      => true,
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
                ],
                'branches' => ['name'],

                'sender' => SenderSample::serialized('octocat'),
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'status' => [
                'id'              => 1,
                'state'           => 'pending',
                'description'     => 'value',
                'targetUrl'       => 'targetUrl',
                'context'         => 'description',
                'externalService' => [
                    'context'   => 'ci/circleci',
                    'className' => 'DevboardLib\GitHub\External\Service\ContinuousIntegration\CircleCi',
                ],
                'creator' => [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ],
            'commit' => [
                'sha'        => 'sha',
                'message'    => 'message',
                'commitDate' => '2018-01-01T00:01:00+00:00',
                'author'     => [
                    'name'      => 'name',
                    'email'     => 'octocat@example.com',
                    'createdAt' => '2018-01-01T00:01:00+00:00',
                    'details'   => [
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
                ],
                'committer' => [
                    'name'        => 'name',
                    'email'       => 'octocat@example.com',
                    'committedAt' => '2018-01-01T00:01:00+00:00',
                    'details'     => [
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
                ],
                'tree'         => ['sha' => 'sha', 'apiUrl' => 'url'],
                'parents'      => [['sha' => 'sha', 'apiUrl' => 'apiUrl', 'htmlUrl' => 'htmlUrl']],
                'verification' => [
                    'verified'  => true,
                    'reason'    => 'reason',
                    'signature' => 'signature',
                    'payload'   => 'payload',
                ],
                'apiUrl'      => 'apiUrl',
                'htmlUrl'     => 'htmlUrl',
                'commentsUrl' => 'commentsUrl',
            ],
            'repo' => [
                'id'       => 1,
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
                'private'       => true,
                'defaultBranch' => 'name',
                'fork'          => true,
                'parent'        => ['id' => 1, 'fullName' => ['owner' => 'value', 'repoName' => 'name']],
                'description'   => 'description',
                'homepage'      => 'homepage',
                'language'      => 'language',
                'mirrorUrl'     => 'mirrorUrl',
                'archived'      => true,
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
            ],
            'branches' => ['name'],
            'sender'   => SenderSample::serialized('octocat'),
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(StatusEvent::class);
    }
}
