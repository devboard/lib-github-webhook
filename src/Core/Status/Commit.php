<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Status;

use DevboardLib\Git\Commit\CommitDate;
use DevboardLib\Git\Commit\CommitMessage;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\GitHub\Commit\CommitParentCollection;
use DevboardLib\GitHub\Commit\CommitTree;
use DevboardLib\GitHub\Commit\CommitVerification;
use Git\Commit as GitCommit;

/**
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 *
 * @see \spec\DevboardLib\GitHubWebhook\Core\Status\CommitSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\Status\CommitTest
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

    /** @var CommitParentCollection */
    private $parents;

    /** @var CommitVerification|null */
    private $verification;

    /** @var string */
    private $commentsUrl;

    public function __construct(
        CommitSha $sha,
        CommitMessage $message,
        CommitDate $commitDate,
        CommitAuthor $author,
        CommitCommitter $committer,
        CommitTree $tree,
        CommitParentCollection $parents,
        ?CommitVerification $verification,
        string $commentsUrl
    ) {
        $this->sha          = $sha;
        $this->message      = $message;
        $this->commitDate   = $commitDate;
        $this->author       = $author;
        $this->committer    = $committer;
        $this->tree         = $tree;
        $this->parents      = $parents;
        $this->verification = $verification;
        $this->commentsUrl  = $commentsUrl;
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

    public function getParents(): CommitParentCollection
    {
        return $this->parents;
    }

    public function getVerification(): ?CommitVerification
    {
        return $this->verification;
    }

    public function getCommentsUrl(): string
    {
        return $this->commentsUrl;
    }

    public function serialize(): array
    {
        if (null !== $this->verification) {
            $verification = $this->verification->serialize();
        } else {
            $verification = null;
        }

        return [
            'sha'          => $this->sha->serialize(),
            'message'      => $this->message->serialize(),
            'commitDate'   => $this->commitDate->serialize(),
            'author'       => $this->author->serialize(),
            'committer'    => $this->committer->serialize(),
            'tree'         => $this->tree->serialize(),
            'parents'      => $this->parents->serialize(),
            'verification' => $verification,
            'commentsUrl'  => $this->commentsUrl,
        ];
    }

    public static function deserialize(array $data): self
    {
        if (null !== $data['verification']) {
            $verification = CommitVerification::deserialize($data['verification']);
        } else {
            $verification = null;
        }

        return new self(
            CommitSha::deserialize($data['sha']),
            CommitMessage::deserialize($data['message']),
            CommitDate::deserialize($data['commitDate']),
            CommitAuthor::deserialize($data['author']),
            CommitCommitter::deserialize($data['committer']),
            CommitTree::deserialize($data['tree']),
            CommitParentCollection::deserialize($data['parents']),
            $verification,
            $data['commentsUrl']
        );
    }
}
