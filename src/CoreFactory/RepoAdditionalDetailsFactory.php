<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory;

use DevboardLib\GitHubWebhook\Core\RepoAdditionalDetails;

class RepoAdditionalDetailsFactory
{
    public function create(array $data): RepoAdditionalDetails
    {
        if (true === array_key_exists('licence', $data)) {
            $licence = $data['licence'];
        } else {
            $licence = null;
        }

        return new RepoAdditionalDetails(
            $licence,
            $data['forks_count'],
            $data['has_downloads'],
            $data['has_issues'],
            $data['has_pages'],
            $data['has_projects'],
            $data['has_wiki']
        );
    }
}
