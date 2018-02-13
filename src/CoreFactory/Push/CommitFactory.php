<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\Git\Commit\Author\AuthorName;
use DevboardLib\Git\Commit\CommitDate;
use DevboardLib\Git\Commit\CommitMessage;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\Git\Commit\Committer\CommitterName;
use DevboardLib\Git\Commit\CommitTree;
use DevboardLib\GitHub\Commit\CommitHtmlUrl;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Push\Commit;
use DevboardLib\GitHubWebhook\Core\Push\CommitAuthor;
use DevboardLib\GitHubWebhook\Core\Push\CommitCommitter;

class CommitFactory
{
    public function create(array $data): Commit
    {
        return new Commit(
            new CommitSha($data['id']),
            new CommitMessage($data['message']),
            new CommitDate($data['timestamp']),
            $this->createAuthor($data['author']),
            $this->createCommitter($data['committer']),
            new CommitTree(new CommitSha($data['tree_id'])),
            new CommitHtmlUrl($data['url']),
            $data['distinct'],
            $data['added'],
            $data['modified'],
            $data['removed']
        );
    }

    private function createAuthor(array $data): CommitAuthor
    {
        if (true === array_key_exists('username', $data)) {
            $username = new UserLogin($data['username']);
        } else {
            $username = null;
        }

        return new CommitAuthor(new AuthorName($data['name']), new EmailAddress($data['email']), $username);
    }

    private function createCommitter(array $data): CommitCommitter
    {
        if (true === array_key_exists('username', $data)) {
            $username = new UserLogin($data['username']);
        } else {
            $username = null;
        }

        return new CommitCommitter(new CommitterName($data['name']), new EmailAddress($data['email']), $username);
    }
}
