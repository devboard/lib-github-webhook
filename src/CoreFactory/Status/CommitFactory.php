<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\Status;

use DateTime;
use DevboardLib\Generix\EmailAddress;
use DevboardLib\Generix\GravatarId;
use DevboardLib\Git\Commit\Author\AuthorName;
use DevboardLib\Git\Commit\CommitDate;
use DevboardLib\Git\Commit\CommitMessage;
use DevboardLib\Git\Commit\CommitSha;
use DevboardLib\Git\Commit\Committer\CommitterName;
use DevboardLib\GitHub\Account\AccountApiUrl;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountHtmlUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\Commit\CommitApiUrl;
use DevboardLib\GitHub\Commit\CommitHtmlUrl;
use DevboardLib\GitHub\Commit\CommitParent;
use DevboardLib\GitHub\Commit\CommitParentCollection;
use DevboardLib\GitHub\Commit\CommitTree;
use DevboardLib\GitHub\Commit\CommitVerification;
use DevboardLib\GitHub\Commit\Tree\TreeApiUrl;
use DevboardLib\GitHub\Commit\Verification\VerificationPayload;
use DevboardLib\GitHub\Commit\Verification\VerificationReason;
use DevboardLib\GitHub\Commit\Verification\VerificationSignature;
use DevboardLib\GitHub\Commit\Verification\VerificationVerified;
use DevboardLib\GitHubWebhook\Core\Status\Commit;
use DevboardLib\GitHubWebhook\Core\Status\CommitAuthor;
use DevboardLib\GitHubWebhook\Core\Status\CommitAuthorDetails;
use DevboardLib\GitHubWebhook\Core\Status\CommitCommitter;
use DevboardLib\GitHubWebhook\Core\Status\CommitCommitterDetails;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 */
class CommitFactory
{
    public function create(array $data): Commit
    {
        if (true === array_key_exists('verification', $data['commit'])) {
            $verification = $this->createVerification($data['commit']['verification']);
        } else {
            $verification = null;
        }

        return new Commit(
            new CommitSha($data['sha']),
            new CommitMessage($data['commit']['message']),
            new CommitDate($data['commit']['author']['date']),
            $this->createAuthor($data['commit']['author'], $data['author']),
            $this->createCommitter($data['commit']['committer'], $data['committer']),
            new CommitTree(
                new CommitSha($data['commit']['tree']['sha']), new TreeApiUrl($data['commit']['tree']['url'])
            ),
            $this->createParentCollection($data['parents']),
            $verification,
            new CommitApiUrl($data['url']),
            new CommitHtmlUrl($data['html_url']),
            $data['comments_url']
        );
    }

    /**
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    private function createAuthor(array $data, ?array $details): CommitAuthor
    {
        if (null !== $details) {
            $authorDetails = new CommitAuthorDetails(
                new AccountId($details['id']),
                new AccountLogin($details['login']),
                new AccountType($details['type']),
                new AccountAvatarUrl($details['avatar_url']),
                new GravatarId($details['gravatar_id']),
                new AccountHtmlUrl($details['html_url']),
                new AccountApiUrl($details['url']),
                $details['site_admin'],
                $details['events_url'],
                $details['followers_url'],
                $details['following_url'],
                $details['gists_url'],
                $details['organizations_url'],
                $details['received_events_url'],
                $details['repos_url'],
                $details['starred_url'],
                $details['subscriptions_url']
            );
        } else {
            $authorDetails = null;
        }

        return new CommitAuthor(
            new AuthorName($data['name']),
            new EmailAddress($data['email']),
            new DateTime($data['date']),
            $authorDetails
        );
    }

    /**
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    private function createCommitter(array $data, ?array $details): CommitCommitter
    {
        if (null !== $details) {
            $committerDetails = new CommitCommitterDetails(
                new AccountId($details['id']),
                new AccountLogin($details['login']),
                new AccountType($details['type']),
                new AccountAvatarUrl($details['avatar_url']),
                new GravatarId($details['gravatar_id']),
                new AccountHtmlUrl($details['html_url']),
                new AccountApiUrl($details['url']),
                $details['site_admin'],
                $details['events_url'],
                $details['followers_url'],
                $details['following_url'],
                $details['gists_url'],
                $details['organizations_url'],
                $details['received_events_url'],
                $details['repos_url'],
                $details['starred_url'],
                $details['subscriptions_url']
            );
        } else {
            $committerDetails = null;
        }

        return new CommitCommitter(
            new CommitterName($data['name']),
            new EmailAddress($data['email']),
            new DateTime($data['date']),
            $committerDetails
        );
    }

    private function createVerification(array $data): CommitVerification
    {
        if (null !== $data['signature']) {
            $signature = new VerificationSignature($data['signature']);
        } else {
            $signature = null;
        }
        if (null !== $data['payload']) {
            $payload = new VerificationPayload($data['payload']);
        } else {
            $payload = null;
        }

        return new CommitVerification(
            new VerificationVerified($data['verified']),
            new VerificationReason($data['reason']),
            $signature,
            $payload
        );
    }

    private function createParentCollection(array $data): CommitParentCollection
    {
        $commitParentCollection = new CommitParentCollection();

        foreach ($data as $parentData) {
            $parent = new CommitParent(
                new CommitSha($parentData['sha']),
                new CommitParent\ParentApiUrl($parentData['url']),
                new CommitParent\ParentHtmlUrl($parentData['html_url'])
            );

            $commitParentCollection->add($parent);
        }

        return $commitParentCollection;
    }
}
