<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\RepoAdditionalUrls;
use PhpSpec\ObjectBehavior;

class RepoAdditionalUrlsSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(
            $archiveUrl = 'https://api.github.com/repos/octocat/linguist/{archive_format}{/ref}',
            $assigneesUrl = 'https://api.github.com/repos/octocat/linguist/assignees{/user}',
            $blobsUrl = 'https://api.github.com/repos/octocat/linguist/git/blobs{/sha}',
            $branchesUrl = 'https://api.github.com/repos/octocat/linguist/branches{/branch}',
            $cloneUrl = 'https://github.com/octocat/linguist.git',
            $collaboratorsUrl = 'https://api.github.com/repos/octocat/linguist/collaborators{/collaborator}',
            $commentsUrl = 'https://api.github.com/repos/octocat/linguist/comments{/number}',
            $commitsUrl = 'https://api.github.com/repos/octocat/linguist/commits{/sha}',
            $compareUrl = 'https://api.github.com/repos/octocat/linguist/compare/{base}...{head}',
            $contentsUrl = 'https://api.github.com/repos/octocat/linguist/contents/{+path}',
            $contributorsUrl = 'https://api.github.com/repos/octocat/linguist/contributors',
            $deploymentsUrl = 'https://api.github.com/repos/octocat/linguist/deployments',
            $downloadsUrl = 'https://api.github.com/repos/octocat/linguist/downloads',
            $eventsUrl = 'https://api.github.com/repos/octocat/linguist/events',
            $forksUrl = 'https://api.github.com/repos/octocat/linguist/forks',
            $gitCommitsUrl = 'https://api.github.com/repos/octocat/linguist/git/commits{/sha}',
            $gitRefsUrl = 'https://api.github.com/repos/octocat/linguist/git/refs{/sha}',
            $gitTagsUrl = 'https://api.github.com/repos/octocat/linguist/git/tags{/sha}',
            $hooksUrl = 'https://api.github.com/repos/octocat/linguist/hooks',
            $issueCommentUrl = 'https://api.github.com/repos/octocat/linguist/issues/comments{/number}',
            $issueEventsUrl = 'https://api.github.com/repos/octocat/linguist/issues/events{/number}',
            $issuesUrl = 'https://api.github.com/repos/octocat/linguist/issues{/number}',
            $keysUrl = 'https://api.github.com/repos/octocat/linguist/keys{/key_id}',
            $labelsUrl = 'https://api.github.com/repos/octocat/linguist/labels{/name}',
            $languagesUrl = 'https://api.github.com/repos/octocat/linguist/languages',
            $mergesUrl = 'https://api.github.com/repos/octocat/linguist/merges',
            $milestonesUrl = 'https://api.github.com/repos/octocat/linguist/milestones{/number}',
            $notificationsUrl = 'https://api.github.com/repos/octocat/linguist/notifications{?since,all,participating}',
            $pullsUrl = 'https://api.github.com/repos/octocat/linguist/pulls{/number}',
            $releasesUrl = 'https://api.github.com/repos/octocat/linguist/releases{/id}',
            $stargazersUrl = 'https://api.github.com/repos/octocat/linguist/stargazers',
            $statusesUrl = 'https://api.github.com/repos/octocat/linguist/statuses/{sha}',
            $subscribersUrl = 'https://api.github.com/repos/octocat/linguist/subscribers',
            $subscriptionUrl = 'https://api.github.com/repos/octocat/linguist/subscription',
            $tagsUrl = 'https://api.github.com/repos/octocat/linguist/tags',
            $teamsUrl = 'https://api.github.com/repos/octocat/linguist/teams',
            $treesUrl = 'https://api.github.com/repos/octocat/linguist/git/trees{/sha}',
            $svnUrl = 'https://github.com/octocat/linguist'
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RepoAdditionalUrls::class);
    }

    public function it_exposes_archive_url()
    {
        $this->getArchiveUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/{archive_format}{/ref}');
    }

    public function it_exposes_assignees_url()
    {
        $this->getAssigneesUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/assignees{/user}');
    }

    public function it_exposes_blobs_url()
    {
        $this->getBlobsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/git/blobs{/sha}');
    }

    public function it_exposes_branches_url()
    {
        $this->getBranchesUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/branches{/branch}');
    }

    public function it_exposes_clone_url()
    {
        $this->getCloneUrl()->shouldReturn('https://github.com/octocat/linguist.git');
    }

    public function it_exposes_collaborators_url()
    {
        $this->getCollaboratorsUrl()->shouldReturn(
            'https://api.github.com/repos/octocat/linguist/collaborators{/collaborator}'
        );
    }

    public function it_exposes_comments_url()
    {
        $this->getCommentsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/comments{/number}');
    }

    public function it_exposes_commits_url()
    {
        $this->getCommitsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/commits{/sha}');
    }

    public function it_exposes_compare_url()
    {
        $this->getCompareUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/compare/{base}...{head}');
    }

    public function it_exposes_contents_url()
    {
        $this->getContentsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/contents/{+path}');
    }

    public function it_exposes_contributors_url()
    {
        $this->getContributorsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/contributors');
    }

    public function it_exposes_deployments_url()
    {
        $this->getDeploymentsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/deployments');
    }

    public function it_exposes_downloads_url()
    {
        $this->getDownloadsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/downloads');
    }

    public function it_exposes_events_url()
    {
        $this->getEventsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/events');
    }

    public function it_exposes_forks_url()
    {
        $this->getForksUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/forks');
    }

    public function it_exposes_git_commits_url()
    {
        $this->getGitCommitsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/git/commits{/sha}');
    }

    public function it_exposes_git_refs_url()
    {
        $this->getGitRefsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/git/refs{/sha}');
    }

    public function it_exposes_git_tags_url()
    {
        $this->getGitTagsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/git/tags{/sha}');
    }

    public function it_exposes_hooks_url()
    {
        $this->getHooksUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/hooks');
    }

    public function it_exposes_issue_comment_url()
    {
        $this->getIssueCommentUrl()->shouldReturn(
            'https://api.github.com/repos/octocat/linguist/issues/comments{/number}'
        );
    }

    public function it_exposes_issue_events_url()
    {
        $this->getIssueEventsUrl()->shouldReturn(
            'https://api.github.com/repos/octocat/linguist/issues/events{/number}'
        );
    }

    public function it_exposes_issues_url()
    {
        $this->getIssuesUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/issues{/number}');
    }

    public function it_exposes_keys_url()
    {
        $this->getKeysUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/keys{/key_id}');
    }

    public function it_exposes_labels_url()
    {
        $this->getLabelsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/labels{/name}');
    }

    public function it_exposes_languages_url()
    {
        $this->getLanguagesUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/languages');
    }

    public function it_exposes_merges_url()
    {
        $this->getMergesUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/merges');
    }

    public function it_exposes_milestones_url()
    {
        $this->getMilestonesUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/milestones{/number}');
    }

    public function it_exposes_notifications_url()
    {
        $this->getNotificationsUrl()->shouldReturn(
            'https://api.github.com/repos/octocat/linguist/notifications{?since,all,participating}'
        );
    }

    public function it_exposes_pulls_url()
    {
        $this->getPullsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/pulls{/number}');
    }

    public function it_exposes_releases_url()
    {
        $this->getReleasesUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/releases{/id}');
    }

    public function it_exposes_stargazers_url()
    {
        $this->getStargazersUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/stargazers');
    }

    public function it_exposes_statuses_url()
    {
        $this->getStatusesUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/statuses/{sha}');
    }

    public function it_exposes_subscribers_url()
    {
        $this->getSubscribersUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/subscribers');
    }

    public function it_exposes_subscription_url()
    {
        $this->getSubscriptionUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/subscription');
    }

    public function it_exposes_tags_url()
    {
        $this->getTagsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/tags');
    }

    public function it_exposes_teams_url()
    {
        $this->getTeamsUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/teams');
    }

    public function it_exposes_trees_url()
    {
        $this->getTreesUrl()->shouldReturn('https://api.github.com/repos/octocat/linguist/git/trees{/sha}');
    }

    public function it_exposes_svn_url()
    {
        $this->getSvnUrl()->shouldReturn('https://github.com/octocat/linguist');
    }

    public function it_can_be_serialized()
    {
        $this->serialize()->shouldReturn(
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
    }

    public function it_can_be_deserialized()
    {
        $input = [
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

        $this->deserialize($input)->shouldReturnAnInstanceOf(RepoAdditionalUrls::class);
    }
}
