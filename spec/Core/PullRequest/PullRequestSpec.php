<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\PullRequest;

use DateTime;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHub\GitHubMilestone;
use DevboardLib\GitHub\PullRequest\PullRequestAssigneeCollection;
use DevboardLib\GitHub\PullRequest\PullRequestAuthor;
use DevboardLib\GitHub\PullRequest\PullRequestBody;
use DevboardLib\GitHub\PullRequest\PullRequestClosedAt;
use DevboardLib\GitHub\PullRequest\PullRequestCreatedAt;
use DevboardLib\GitHub\PullRequest\PullRequestId;
use DevboardLib\GitHub\PullRequest\PullRequestNumber;
use DevboardLib\GitHub\PullRequest\PullRequestState;
use DevboardLib\GitHub\PullRequest\PullRequestTitle;
use DevboardLib\GitHub\PullRequest\PullRequestUpdatedAt;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequest;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestBase;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestHead;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestMergedBy;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedReviewerCollection;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedTeamCollection;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestStats;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestUrls;
use PhpSpec\ObjectBehavior;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 */
class PullRequestSpec extends ObjectBehavior
{
    public function let(
        PullRequestId $id,
        PullRequestNumber $number,
        PullRequestBase $base,
        PullRequestHead $head,
        PullRequestTitle $title,
        PullRequestBody $body,
        PullRequestState $state,
        PullRequestAuthor $author,
        PullRequestAssigneeCollection $assignees,
        PullRequestRequestedReviewerCollection $requestedReviewers,
        PullRequestRequestedTeamCollection $requestedTeams,
        CommitSha $mergeCommitSha,
        DateTime $mergedAt,
        PullRequestMergedBy $mergedBy,
        GitHubMilestone $milestone,
        PullRequestClosedAt $closedAt,
        PullRequestStats $stats,
        PullRequestUrls $urls,
        PullRequestCreatedAt $createdAt,
        PullRequestUpdatedAt $updatedAt
    ) {
        $this->beConstructedWith(
            $id,
            $number,
            $base,
            $head,
            $title,
            $body,
            $state,
            $author,
            $assignees,
            $requestedReviewers,
            $requestedTeams,
            $locked = true,
            $rebaseable = true,
            $maintainerCanModify = true,
            $mergeCommitSha,
            $mergeable = true,
            $mergeableState = 'mergeableState',
            $merged = true,
            $mergedAt,
            $mergedBy,
            $milestone,
            $closedAt,
            $stats,
            $urls,
            $createdAt,
            $updatedAt
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PullRequest::class);
    }

    public function it_exposes_id(PullRequestId $id)
    {
        $this->getId()->shouldReturn($id);
    }

    public function it_exposes_number(PullRequestNumber $number)
    {
        $this->getNumber()->shouldReturn($number);
    }

    public function it_exposes_base(PullRequestBase $base)
    {
        $this->getBase()->shouldReturn($base);
    }

    public function it_exposes_head(PullRequestHead $head)
    {
        $this->getHead()->shouldReturn($head);
    }

    public function it_exposes_title(PullRequestTitle $title)
    {
        $this->getTitle()->shouldReturn($title);
    }

    public function it_exposes_body(PullRequestBody $body)
    {
        $this->getBody()->shouldReturn($body);
    }

    public function it_exposes_state(PullRequestState $state)
    {
        $this->getState()->shouldReturn($state);
    }

    public function it_exposes_author(PullRequestAuthor $author)
    {
        $this->getAuthor()->shouldReturn($author);
    }

    public function it_exposes_assignees(PullRequestAssigneeCollection $assignees)
    {
        $this->getAssignees()->shouldReturn($assignees);
    }

    public function it_exposes_requested_reviewers(PullRequestRequestedReviewerCollection $requestedReviewers)
    {
        $this->getRequestedReviewers()->shouldReturn($requestedReviewers);
    }

    public function it_exposes_requested_teams(PullRequestRequestedTeamCollection $requestedTeams)
    {
        $this->getRequestedTeams()->shouldReturn($requestedTeams);
    }

    public function it_exposes_is_locked()
    {
        $this->isLocked()->shouldReturn(true);
    }

    public function it_exposes_is_rebaseable()
    {
        $this->isRebaseable()->shouldReturn(true);
    }

    public function it_exposes_is_maintainer_can_modify()
    {
        $this->isMaintainerCanModify()->shouldReturn(true);
    }

    public function it_exposes_merge_commit_sha(CommitSha $mergeCommitSha)
    {
        $this->getMergeCommitSha()->shouldReturn($mergeCommitSha);
    }

    public function it_exposes_is_mergeable()
    {
        $this->isMergeable()->shouldReturn(true);
    }

    public function it_exposes_mergeable_state()
    {
        $this->getMergeableState()->shouldReturn('mergeableState');
    }

    public function it_exposes_is_merged()
    {
        $this->isMerged()->shouldReturn(true);
    }

    public function it_exposes_merged_at(DateTime $mergedAt)
    {
        $this->getMergedAt()->shouldReturn($mergedAt);
    }

    public function it_exposes_merged_by(PullRequestMergedBy $mergedBy)
    {
        $this->getMergedBy()->shouldReturn($mergedBy);
    }

    public function it_exposes_milestone(GitHubMilestone $milestone)
    {
        $this->getMilestone()->shouldReturn($milestone);
    }

    public function it_exposes_closed_at(PullRequestClosedAt $closedAt)
    {
        $this->getClosedAt()->shouldReturn($closedAt);
    }

    public function it_exposes_stats(PullRequestStats $stats)
    {
        $this->getStats()->shouldReturn($stats);
    }

    public function it_exposes_urls(PullRequestUrls $urls)
    {
        $this->getUrls()->shouldReturn($urls);
    }

    public function it_exposes_created_at(PullRequestCreatedAt $createdAt)
    {
        $this->getCreatedAt()->shouldReturn($createdAt);
    }

    public function it_exposes_updated_at(PullRequestUpdatedAt $updatedAt)
    {
        $this->getUpdatedAt()->shouldReturn($updatedAt);
    }

    public function it_has_rebaseable()
    {
        $this->hasRebaseable()->shouldReturn(true);
    }

    public function it_has_merge_commit_sha()
    {
        $this->hasMergeCommitSha()->shouldReturn(true);
    }

    public function it_has_mergeable()
    {
        $this->hasMergeable()->shouldReturn(true);
    }

    public function it_has_merged_at()
    {
        $this->hasMergedAt()->shouldReturn(true);
    }

    public function it_has_merged_by()
    {
        $this->hasMergedBy()->shouldReturn(true);
    }

    public function it_has_milestone()
    {
        $this->hasMilestone()->shouldReturn(true);
    }

    public function it_has_closed_at()
    {
        $this->hasClosedAt()->shouldReturn(true);
    }

    public function it_can_be_serialized(
        PullRequestId $id,
        PullRequestNumber $number,
        PullRequestBase $base,
        PullRequestHead $head,
        PullRequestTitle $title,
        PullRequestBody $body,
        PullRequestState $state,
        PullRequestAuthor $author,
        PullRequestAssigneeCollection $assignees,
        PullRequestRequestedReviewerCollection $requestedReviewers,
        PullRequestRequestedTeamCollection $requestedTeams,
        CommitSha $mergeCommitSha,
        DateTime $mergedAt,
        PullRequestMergedBy $mergedBy,
        GitHubMilestone $milestone,
        PullRequestClosedAt $closedAt,
        PullRequestStats $stats,
        PullRequestUrls $urls,
        PullRequestCreatedAt $createdAt,
        PullRequestUpdatedAt $updatedAt
    ) {
        $id->serialize()->shouldBeCalled()->willReturn(1);
        $number->serialize()->shouldBeCalled()->willReturn(1);
        $base->serialize()->shouldBeCalled()->willReturn(
            [
                'targetBranchName' => 'name',
                'repo'             => [
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
                'sha' => 'sha',
            ]
        );
        $head->serialize()->shouldBeCalled()->willReturn(
            [
                'sourceBranchName' => 'name',
                'repo'             => [
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
                'sha' => 'sha',
            ]
        );
        $title->serialize()->shouldBeCalled()->willReturn('value');
        $body->serialize()->shouldBeCalled()->willReturn('value');
        $state->serialize()->shouldBeCalled()->willReturn('open');
        $author->serialize()->shouldBeCalled()->willReturn(
            ['userId' => 1, 'login' => 'value', 'type' => 'User', 'avatarUrl' => 'avatarUrl', 'siteAdmin' => true]
        );
        $assignees->serialize()->shouldBeCalled()->willReturn(
            [
                [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
            ]
        );
        $requestedReviewers->serialize()->shouldBeCalled()->willReturn(
            [
                [
                    'userId'            => 1,
                    'login'             => 'value',
                    'type'              => 'User',
                    'avatarUrl'         => 'avatarUrl',
                    'siteAdmin'         => true,
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
            ]
        );
        $requestedTeams->serialize()->shouldBeCalled()->willReturn(['todo']);
        $mergeCommitSha->serialize()->shouldBeCalled()->willReturn('sha');
        $mergedAt->format('c')->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $mergedBy->serialize()->shouldBeCalled()->willReturn(
            [
                'userId'            => 1,
                'login'             => 'value',
                'type'              => 'User',
                'avatarUrl'         => 'avatarUrl',
                'siteAdmin'         => true,
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
        $milestone->serialize()->shouldBeCalled()->willReturn(
            [
                'id'          => 1,
                'title'       => 'value',
                'description' => 'value',
                'dueOn'       => '2018-01-01T00:01:00+00:00',
                'state'       => 'open',
                'number'      => 1,
                'creator'     => [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
                'htmlUrl'   => 'htmlUrl',
                'apiUrl'    => 'apiUrl',
                'closedAt'  => '2018-01-01T00:01:00+00:00',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ]
        );
        $closedAt->serialize()->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $stats->serialize()->shouldBeCalled()->willReturn(
            ['additions' => 1, 'changedFiles' => 1, 'comments' => 1, 'commits' => 1, 'deletions' => 1]
        );
        $urls->serialize()->shouldBeCalled()->willReturn(
            [
                'apiUrl'            => 'apiUrl',
                'htmlUrl'           => 'htmlUrl',
                'commentsUrl'       => 'commentsUrl',
                'commitsUrl'        => 'commitsUrl',
                'diffUrl'           => 'diffUrl',
                'issueUrl'          => 'issueUrl',
                'patchUrl'          => 'patchUrl',
                'reviewCommentUrl'  => 'reviewCommentUrl',
                'reviewComments'    => 1,
                'reviewCommentsUrl' => 'reviewCommentsUrl',
                'statusesUrl'       => 'statusesUrl',
            ]
        );
        $createdAt->serialize()->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $updatedAt->serialize()->shouldBeCalled()->willReturn('2018-01-01T00:01:00+00:00');
        $this->serialize()->shouldReturn(
            [
                'id'     => 1,
                'number' => 1,
                'base'   => [
                    'targetBranchName' => 'name',
                    'repo'             => [
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
                    'sha' => 'sha',
                ],
                'head' => [
                    'sourceBranchName' => 'name',
                    'repo'             => [
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
                    'sha' => 'sha',
                ],
                'title'  => 'value',
                'body'   => 'value',
                'state'  => 'open',
                'author' => [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
                'assignees' => [
                    [
                        'userId'    => 1,
                        'login'     => 'value',
                        'type'      => 'User',
                        'avatarUrl' => 'avatarUrl',
                        'siteAdmin' => true,
                    ],
                ],
                'requestedReviewers' => [
                    [
                        'userId'            => 1,
                        'login'             => 'value',
                        'type'              => 'User',
                        'avatarUrl'         => 'avatarUrl',
                        'siteAdmin'         => true,
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
                'requestedTeams'      => ['todo'],
                'locked'              => true,
                'rebaseable'          => true,
                'maintainerCanModify' => true,
                'mergeCommitSha'      => 'sha',
                'mergeable'           => true,
                'mergeableState'      => 'mergeableState',
                'merged'              => true,
                'mergedAt'            => '2018-01-01T00:01:00+00:00',
                'mergedBy'            => [
                    'userId'            => 1,
                    'login'             => 'value',
                    'type'              => 'User',
                    'avatarUrl'         => 'avatarUrl',
                    'siteAdmin'         => true,
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
                'milestone' => [
                    'id'          => 1,
                    'title'       => 'value',
                    'description' => 'value',
                    'dueOn'       => '2018-01-01T00:01:00+00:00',
                    'state'       => 'open',
                    'number'      => 1,
                    'creator'     => [
                        'userId'    => 1,
                        'login'     => 'value',
                        'type'      => 'User',
                        'avatarUrl' => 'avatarUrl',
                        'siteAdmin' => true,
                    ],
                    'htmlUrl'   => 'htmlUrl',
                    'apiUrl'    => 'apiUrl',
                    'closedAt'  => '2018-01-01T00:01:00+00:00',
                    'createdAt' => '2018-01-01T00:01:00+00:00',
                    'updatedAt' => '2018-01-01T00:01:00+00:00',
                ],
                'closedAt' => '2018-01-01T00:01:00+00:00',
                'stats'    => ['additions' => 1, 'changedFiles' => 1, 'comments' => 1, 'commits' => 1, 'deletions' => 1],
                'urls'     => [
                    'apiUrl'            => 'apiUrl',
                    'htmlUrl'           => 'htmlUrl',
                    'commentsUrl'       => 'commentsUrl',
                    'commitsUrl'        => 'commitsUrl',
                    'diffUrl'           => 'diffUrl',
                    'issueUrl'          => 'issueUrl',
                    'patchUrl'          => 'patchUrl',
                    'reviewCommentUrl'  => 'reviewCommentUrl',
                    'reviewComments'    => 1,
                    'reviewCommentsUrl' => 'reviewCommentsUrl',
                    'statusesUrl'       => 'statusesUrl',
                ],
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'id'     => 1,
            'number' => 1,
            'base'   => [
                'targetBranchName' => 'name',
                'repo'             => [
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
                'sha' => 'sha',
            ],
            'head' => [
                'sourceBranchName' => 'name',
                'repo'             => [
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
                'sha' => 'sha',
            ],
            'title'  => 'value',
            'body'   => 'value',
            'state'  => 'open',
            'author' => [
                'userId'      => 1,
                'login'       => 'value',
                'type'        => 'User',
                'association' => 'COLLABORATOR',
                'avatarUrl'   => 'avatarUrl',
                'siteAdmin'   => true,
            ],
            'assignees' => [
                [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
            ],
            'requestedReviewers' => [
                [
                    'userId'            => 1,
                    'login'             => 'value',
                    'type'              => 'User',
                    'avatarUrl'         => 'avatarUrl',
                    'siteAdmin'         => true,
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
            'requestedTeams'      => ['todo'],
            'locked'              => true,
            'rebaseable'          => true,
            'maintainerCanModify' => true,
            'mergeCommitSha'      => 'sha',
            'mergeable'           => true,
            'mergeableState'      => 'mergeableState',
            'merged'              => true,
            'mergedAt'            => '2018-01-01T00:01:00+00:00',
            'mergedBy'            => [
                'userId'            => 1,
                'login'             => 'value',
                'type'              => 'User',
                'avatarUrl'         => 'avatarUrl',
                'siteAdmin'         => true,
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
            'milestone' => [
                'id'          => 1,
                'title'       => 'value',
                'description' => 'value',
                'dueOn'       => '2018-01-01T00:01:00+00:00',
                'state'       => 'open',
                'number'      => 1,
                'creator'     => [
                    'userId'    => 1,
                    'login'     => 'value',
                    'type'      => 'User',
                    'avatarUrl' => 'avatarUrl',
                    'siteAdmin' => true,
                ],
                'htmlUrl'   => 'htmlUrl',
                'apiUrl'    => 'apiUrl',
                'closedAt'  => '2018-01-01T00:01:00+00:00',
                'createdAt' => '2018-01-01T00:01:00+00:00',
                'updatedAt' => '2018-01-01T00:01:00+00:00',
            ],
            'closedAt' => '2018-01-01T00:01:00+00:00',
            'stats'    => ['additions' => 1, 'changedFiles' => 1, 'comments' => 1, 'commits' => 1, 'deletions' => 1],
            'urls'     => [
                'apiUrl'            => 'apiUrl',
                'htmlUrl'           => 'htmlUrl',
                'commentsUrl'       => 'commentsUrl',
                'commitsUrl'        => 'commitsUrl',
                'diffUrl'           => 'diffUrl',
                'issueUrl'          => 'issueUrl',
                'patchUrl'          => 'patchUrl',
                'reviewCommentUrl'  => 'reviewCommentUrl',
                'reviewComments'    => 1,
                'reviewCommentsUrl' => 'reviewCommentsUrl',
                'statusesUrl'       => 'statusesUrl',
            ],
            'createdAt' => '2018-01-01T00:01:00+00:00',
            'updatedAt' => '2018-01-01T00:01:00+00:00',
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(PullRequest::class);
    }
}
