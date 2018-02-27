<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Hook\Label;

use Data\DevboardLib\GitHubWebhook\Core\Label\LabelSample;
use Data\DevboardLib\GitHubWebhook\Core\RepoSample;
use Data\DevboardLib\GitHubWebhook\Core\SenderSample;
use DevboardLib\GitHub\GitHubLabel;
use DevboardLib\GitHub\Installation\InstallationId;
use DevboardLib\GitHubWebhook\Core\Repo;
use DevboardLib\GitHubWebhook\Core\Sender;
use DevboardLib\GitHubWebhook\Hook\Label\DeletedLabelEvent;
use DevboardLib\GitHubWebhook\Hook\Label\LabelEvent;
use PhpSpec\ObjectBehavior;

class DeletedLabelEventSpec extends ObjectBehavior
{
    public function let(GitHubLabel $label, Repo $repo, InstallationId $installationId, Sender $sender)
    {
        $this->beConstructedWith($label, $repo, $installationId, $sender);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(DeletedLabelEvent::class);
        $this->shouldImplement(LabelEvent::class);
    }

    public function it_exposes_label(GitHubLabel $label)
    {
        $this->getLabel()->shouldReturn($label);
    }

    public function it_exposes_repo(Repo $repo)
    {
        $this->getRepo()->shouldReturn($repo);
    }

    public function it_exposes_installation_id(InstallationId $installationId)
    {
        $this->getInstallationId()->shouldReturn($installationId);
    }

    public function it_exposes_sender(Sender $sender)
    {
        $this->getSender()->shouldReturn($sender);
    }

    public function it_can_be_serialized(
        GitHubLabel $label, Repo $repo, InstallationId $installationId, Sender $sender
    ) {
        $label->serialize()->shouldBeCalled()->willReturn(LabelSample::serialized('red'));
        $repo->serialize()->shouldBeCalled()->willReturn(
            [
                'id'       => 1,
                'fullName' => ['owner' => 'value', 'repoName' => 'name'],
                'owner'    => [
                    'userId'            => 1,
                    'login'             => 'value',
                    'type'              => 'User',
                    'avatarUrl'         => 'avatarUrl',
                    'gravatarId'        => 'id',
                    'htmlUrl'           => 'htmlUrl',
                    'apiUrl'            => 'apiUrl',
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
        $installationId->serialize()->shouldBeCalled()->willReturn(1);
        $sender->serialize()->shouldBeCalled()->willReturn(SenderSample::serialized('octocat'));
        $this->serialize()->shouldReturn(
            [
                'label' => LabelSample::serialized('red'),
                'repo'  => [
                    'id'       => 1,
                    'fullName' => ['owner' => 'value', 'repoName' => 'name'],
                    'owner'    => [
                        'userId'            => 1,
                        'login'             => 'value',
                        'type'              => 'User',
                        'avatarUrl'         => 'avatarUrl',
                        'gravatarId'        => 'id',
                        'htmlUrl'           => 'htmlUrl',
                        'apiUrl'            => 'apiUrl',
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
                'installationId' => 1,
                'sender'         => SenderSample::serialized('octocat'),
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'label'          => LabelSample::serialized('red'),
            'repo'           => RepoSample::serialized('octocatLinguist'),
            'installationId' => 1,
            'sender'         => SenderSample::serialized('octocat'),
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(DeletedLabelEvent::class);
    }
}
