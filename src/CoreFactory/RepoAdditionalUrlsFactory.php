<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHubWebhook\Core\RepoAdditionalUrls;

class RepoAdditionalUrlsFactory
{
    public function create(array $data): RepoAdditionalUrls
    {
        return new RepoAdditionalUrls(
            $data['archive_url'],
            $data['assignees_url'],
            $data['blobs_url'],
            $data['branches_url'],
            $data['clone_url'],
            $data['collaborators_url'],
            $data['comments_url'],
            $data['commits_url'],
            $data['compare_url'],
            $data['contents_url'],
            $data['contributors_url'],
            $data['deployments_url'],
            $data['downloads_url'],
            $data['events_url'],
            $data['forks_url'],
            $data['git_commits_url'],
            $data['git_refs_url'],
            $data['git_tags_url'],
            $data['hooks_url'],
            $data['issue_comment_url'],
            $data['issue_events_url'],
            $data['issues_url'],
            $data['keys_url'],
            $data['labels_url'],
            $data['languages_url'],
            $data['merges_url'],
            $data['milestones_url'],
            $data['notifications_url'],
            $data['pulls_url'],
            $data['releases_url'],
            $data['stargazers_url'],
            $data['statuses_url'],
            $data['subscribers_url'],
            $data['subscription_url'],
            $data['tags_url'],
            $data['teams_url'],
            $data['trees_url'],
            $data['svn_url']
        );
    }
}
