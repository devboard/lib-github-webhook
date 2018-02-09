<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\Git\Commit\CommitDate;
use DevboardLib\Git\Commit\CommitMessage;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\Git\Commit\CommitTree;
use DevboardLib\GitHub\Commit\CommitHtmlUrl;
use Git\Commit as GitCommit;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\Push\CommitSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\Push\CommitTest
 */
class Commit implements GitCommit
{
    /** @var CommitSha */
    private $sha;

    /** @var CommitMessage */
    private $message;

    /** @var CommitDate */
    private $commitDate;

    /** @var CommitAuthor */
    private $author;

    /** @var CommitCommitter */
    private $committer;

    /** @var CommitTree */
    private $tree;

    /** @var CommitHtmlUrl */
    private $htmlUrl;

    /** @var bool */
    private $distinct;

    /** @var array */
    private $addedFiles;

    /** @var array */
    private $modifiedFiles;

    /** @var array */
    private $removedFiles;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        CommitSha $sha,
        CommitMessage $message,
        CommitDate $commitDate,
        CommitAuthor $author,
        CommitCommitter $committer,
        CommitTree $tree,
        CommitHtmlUrl $htmlUrl,
        bool $distinct,
        array $addedFiles,
        array $modifiedFiles,
        array $removedFiles
    ) {
        $this->sha           = $sha;
        $this->message       = $message;
        $this->commitDate    = $commitDate;
        $this->author        = $author;
        $this->committer     = $committer;
        $this->tree          = $tree;
        $this->htmlUrl       = $htmlUrl;
        $this->distinct      = $distinct;
        $this->addedFiles    = $addedFiles;
        $this->modifiedFiles = $modifiedFiles;
        $this->removedFiles  = $removedFiles;
    }

    public function getSha(): CommitSha
    {
        return $this->sha;
    }

    public function getMessage(): CommitMessage
    {
        return $this->message;
    }

    public function getCommitDate(): CommitDate
    {
        return $this->commitDate;
    }

    public function getAuthor(): CommitAuthor
    {
        return $this->author;
    }

    public function getCommitter(): CommitCommitter
    {
        return $this->committer;
    }

    public function getTree(): CommitTree
    {
        return $this->tree;
    }

    public function getHtmlUrl(): CommitHtmlUrl
    {
        return $this->htmlUrl;
    }

    public function isDisctinct(): bool
    {
        return $this->distinct;
    }

    public function getAddedFiles(): array
    {
        return $this->addedFiles;
    }

    public function getModifiedFiles(): array
    {
        return $this->modifiedFiles;
    }

    public function getRemovedFiles(): array
    {
        return $this->removedFiles;
    }

    public function getParents()
    {
        return null;
    }

    public function serialize(): array
    {
        return [
            'sha'           => $this->sha->serialize(),
            'message'       => $this->message->serialize(),
            'commitDate'    => $this->commitDate->serialize(),
            'author'        => $this->author->serialize(),
            'committer'     => $this->committer->serialize(),
            'tree'          => $this->tree->serialize(),
            'htmlUrl'       => $this->htmlUrl->serialize(),
            'distinct'      => $this->distinct,
            'addedFiles'    => $this->addedFiles,
            'modifiedFiles' => $this->modifiedFiles,
            'removedFiles'  => $this->removedFiles,
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            CommitSha::deserialize($data['sha']),
            CommitMessage::deserialize($data['message']),
            CommitDate::deserialize($data['commitDate']),
            CommitAuthor::deserialize($data['author']),
            CommitCommitter::deserialize($data['committer']),
            CommitTree::deserialize($data['tree']),
            CommitHtmlUrl::deserialize($data['htmlUrl']),
            $data['distinct'],
            $data['addedFiles'],
            $data['modifiedFiles'],
            $data['removedFiles']
        );
    }
}
