<?php

declare(strict_types=1);

namespace Data\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\Repo;

class RepoSample
{
    private static $data = [
        'octocatLinguist' => [
            'id'       => 64778136,
            'fullName' => ['owner' => 'octocat', 'repoName' => 'linguist'],
            'owner'    => [
                'userId'            => 1,
                'login'             => 'octocat',
                'type'              => 'User',
                'avatarUrl'         => 'avatarUrl',
                'gravatarId'        => 'id',
                'htmlUrl'           => 'htmlUrl',
                'apiUrl'            => 'apiUrl',
                'siteAdmin'         => true,
                'name'              => 'octocat',
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
        ],
    ];

    public static function serialized(string $item): array
    {
        return self::$data[$item];
    }

    public static function octocatLinguist(): Repo
    {
        return Repo::deserialize(self::$data['octocatLinguist']);
    }
}
