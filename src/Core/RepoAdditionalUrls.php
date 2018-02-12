<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core;

/**
 * @SuppressWarnings(PHPMD.TooManyFields)
 *
 * @see \spec\DevboardLib\GitHubWebhook\Core\RepoAdditionalUrlsSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\RepoAdditionalUrlsTest
 */
class RepoAdditionalUrls
{
    /** @var string */
    private $archiveUrl;

    /** @var string */
    private $assigneesUrl;

    /** @var string */
    private $blobsUrl;

    /** @var string */
    private $branchesUrl;

    /** @var string */
    private $cloneUrl;

    /** @var string */
    private $collaboratorsUrl;

    /** @var string */
    private $commentsUrl;

    /** @var string */
    private $commitsUrl;

    /** @var string */
    private $compareUrl;

    /** @var string */
    private $contentsUrl;

    /** @var string */
    private $contributorsUrl;

    /** @var string */
    private $deploymentsUrl;

    /** @var string */
    private $downloadsUrl;

    /** @var string */
    private $eventsUrl;

    /** @var string */
    private $forksUrl;

    /** @var string */
    private $gitCommitsUrl;

    /** @var string */
    private $gitRefsUrl;

    /** @var string */
    private $gitTagsUrl;

    /** @var string */
    private $hooksUrl;

    /** @var string */
    private $issueCommentUrl;

    /** @var string */
    private $issueEventsUrl;

    /** @var string */
    private $issuesUrl;

    /** @var string */
    private $keysUrl;

    /** @var string */
    private $labelsUrl;

    /** @var string */
    private $languagesUrl;

    /** @var string */
    private $mergesUrl;

    /** @var string */
    private $milestonesUrl;

    /** @var string */
    private $notificationsUrl;

    /** @var string */
    private $pullsUrl;

    /** @var string */
    private $releasesUrl;

    /** @var string */
    private $stargazersUrl;

    /** @var string */
    private $statusesUrl;

    /** @var string */
    private $subscribersUrl;

    /** @var string */
    private $subscriptionUrl;

    /** @var string */
    private $tagsUrl;

    /** @var string */
    private $teamsUrl;

    /** @var string */
    private $treesUrl;

    /** @var string */
    private $svnUrl;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        string $archiveUrl,
        string $assigneesUrl,
        string $blobsUrl,
        string $branchesUrl,
        string $cloneUrl,
        string $collaboratorsUrl,
        string $commentsUrl,
        string $commitsUrl,
        string $compareUrl,
        string $contentsUrl,
        string $contributorsUrl,
        string $deploymentsUrl,
        string $downloadsUrl,
        string $eventsUrl,
        string $forksUrl,
        string $gitCommitsUrl,
        string $gitRefsUrl,
        string $gitTagsUrl,
        string $hooksUrl,
        string $issueCommentUrl,
        string $issueEventsUrl,
        string $issuesUrl,
        string $keysUrl,
        string $labelsUrl,
        string $languagesUrl,
        string $mergesUrl,
        string $milestonesUrl,
        string $notificationsUrl,
        string $pullsUrl,
        string $releasesUrl,
        string $stargazersUrl,
        string $statusesUrl,
        string $subscribersUrl,
        string $subscriptionUrl,
        string $tagsUrl,
        string $teamsUrl,
        string $treesUrl,
        string $svnUrl
    ) {
        $this->archiveUrl       = $archiveUrl;
        $this->assigneesUrl     = $assigneesUrl;
        $this->blobsUrl         = $blobsUrl;
        $this->branchesUrl      = $branchesUrl;
        $this->cloneUrl         = $cloneUrl;
        $this->collaboratorsUrl = $collaboratorsUrl;
        $this->commentsUrl      = $commentsUrl;
        $this->commitsUrl       = $commitsUrl;
        $this->compareUrl       = $compareUrl;
        $this->contentsUrl      = $contentsUrl;
        $this->contributorsUrl  = $contributorsUrl;
        $this->deploymentsUrl   = $deploymentsUrl;
        $this->downloadsUrl     = $downloadsUrl;
        $this->eventsUrl        = $eventsUrl;
        $this->forksUrl         = $forksUrl;
        $this->gitCommitsUrl    = $gitCommitsUrl;
        $this->gitRefsUrl       = $gitRefsUrl;
        $this->gitTagsUrl       = $gitTagsUrl;
        $this->hooksUrl         = $hooksUrl;
        $this->issueCommentUrl  = $issueCommentUrl;
        $this->issueEventsUrl   = $issueEventsUrl;
        $this->issuesUrl        = $issuesUrl;
        $this->keysUrl          = $keysUrl;
        $this->labelsUrl        = $labelsUrl;
        $this->languagesUrl     = $languagesUrl;
        $this->mergesUrl        = $mergesUrl;
        $this->milestonesUrl    = $milestonesUrl;
        $this->notificationsUrl = $notificationsUrl;
        $this->pullsUrl         = $pullsUrl;
        $this->releasesUrl      = $releasesUrl;
        $this->stargazersUrl    = $stargazersUrl;
        $this->statusesUrl      = $statusesUrl;
        $this->subscribersUrl   = $subscribersUrl;
        $this->subscriptionUrl  = $subscriptionUrl;
        $this->tagsUrl          = $tagsUrl;
        $this->teamsUrl         = $teamsUrl;
        $this->treesUrl         = $treesUrl;
        $this->svnUrl           = $svnUrl;
    }

    public function getArchiveUrl(): string
    {
        return $this->archiveUrl;
    }

    public function getAssigneesUrl(): string
    {
        return $this->assigneesUrl;
    }

    public function getBlobsUrl(): string
    {
        return $this->blobsUrl;
    }

    public function getBranchesUrl(): string
    {
        return $this->branchesUrl;
    }

    public function getCloneUrl(): string
    {
        return $this->cloneUrl;
    }

    public function getCollaboratorsUrl(): string
    {
        return $this->collaboratorsUrl;
    }

    public function getCommentsUrl(): string
    {
        return $this->commentsUrl;
    }

    public function getCommitsUrl(): string
    {
        return $this->commitsUrl;
    }

    public function getCompareUrl(): string
    {
        return $this->compareUrl;
    }

    public function getContentsUrl(): string
    {
        return $this->contentsUrl;
    }

    public function getContributorsUrl(): string
    {
        return $this->contributorsUrl;
    }

    public function getDeploymentsUrl(): string
    {
        return $this->deploymentsUrl;
    }

    public function getDownloadsUrl(): string
    {
        return $this->downloadsUrl;
    }

    public function getEventsUrl(): string
    {
        return $this->eventsUrl;
    }

    public function getForksUrl(): string
    {
        return $this->forksUrl;
    }

    public function getGitCommitsUrl(): string
    {
        return $this->gitCommitsUrl;
    }

    public function getGitRefsUrl(): string
    {
        return $this->gitRefsUrl;
    }

    public function getGitTagsUrl(): string
    {
        return $this->gitTagsUrl;
    }

    public function getHooksUrl(): string
    {
        return $this->hooksUrl;
    }

    public function getIssueCommentUrl(): string
    {
        return $this->issueCommentUrl;
    }

    public function getIssueEventsUrl(): string
    {
        return $this->issueEventsUrl;
    }

    public function getIssuesUrl(): string
    {
        return $this->issuesUrl;
    }

    public function getKeysUrl(): string
    {
        return $this->keysUrl;
    }

    public function getLabelsUrl(): string
    {
        return $this->labelsUrl;
    }

    public function getLanguagesUrl(): string
    {
        return $this->languagesUrl;
    }

    public function getMergesUrl(): string
    {
        return $this->mergesUrl;
    }

    public function getMilestonesUrl(): string
    {
        return $this->milestonesUrl;
    }

    public function getNotificationsUrl(): string
    {
        return $this->notificationsUrl;
    }

    public function getPullsUrl(): string
    {
        return $this->pullsUrl;
    }

    public function getReleasesUrl(): string
    {
        return $this->releasesUrl;
    }

    public function getStargazersUrl(): string
    {
        return $this->stargazersUrl;
    }

    public function getStatusesUrl(): string
    {
        return $this->statusesUrl;
    }

    public function getSubscribersUrl(): string
    {
        return $this->subscribersUrl;
    }

    public function getSubscriptionUrl(): string
    {
        return $this->subscriptionUrl;
    }

    public function getTagsUrl(): string
    {
        return $this->tagsUrl;
    }

    public function getTeamsUrl(): string
    {
        return $this->teamsUrl;
    }

    public function getTreesUrl(): string
    {
        return $this->treesUrl;
    }

    public function getSvnUrl(): string
    {
        return $this->svnUrl;
    }

    public function serialize(): array
    {
        return [
            'archiveUrl'       => $this->archiveUrl,
            'assigneesUrl'     => $this->assigneesUrl,
            'blobsUrl'         => $this->blobsUrl,
            'branchesUrl'      => $this->branchesUrl,
            'cloneUrl'         => $this->cloneUrl,
            'collaboratorsUrl' => $this->collaboratorsUrl,
            'commentsUrl'      => $this->commentsUrl,
            'commitsUrl'       => $this->commitsUrl,
            'compareUrl'       => $this->compareUrl,
            'contentsUrl'      => $this->contentsUrl,
            'contributorsUrl'  => $this->contributorsUrl,
            'deploymentsUrl'   => $this->deploymentsUrl,
            'downloadsUrl'     => $this->downloadsUrl,
            'eventsUrl'        => $this->eventsUrl,
            'forksUrl'         => $this->forksUrl,
            'gitCommitsUrl'    => $this->gitCommitsUrl,
            'gitRefsUrl'       => $this->gitRefsUrl,
            'gitTagsUrl'       => $this->gitTagsUrl,
            'hooksUrl'         => $this->hooksUrl,
            'issueCommentUrl'  => $this->issueCommentUrl,
            'issueEventsUrl'   => $this->issueEventsUrl,
            'issuesUrl'        => $this->issuesUrl,
            'keysUrl'          => $this->keysUrl,
            'labelsUrl'        => $this->labelsUrl,
            'languagesUrl'     => $this->languagesUrl,
            'mergesUrl'        => $this->mergesUrl,
            'milestonesUrl'    => $this->milestonesUrl,
            'notificationsUrl' => $this->notificationsUrl,
            'pullsUrl'         => $this->pullsUrl,
            'releasesUrl'      => $this->releasesUrl,
            'stargazersUrl'    => $this->stargazersUrl,
            'statusesUrl'      => $this->statusesUrl,
            'subscribersUrl'   => $this->subscribersUrl,
            'subscriptionUrl'  => $this->subscriptionUrl,
            'tagsUrl'          => $this->tagsUrl,
            'teamsUrl'         => $this->teamsUrl,
            'treesUrl'         => $this->treesUrl,
            'svnUrl'           => $this->svnUrl,
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            $data['archiveUrl'],
            $data['assigneesUrl'],
            $data['blobsUrl'],
            $data['branchesUrl'],
            $data['cloneUrl'],
            $data['collaboratorsUrl'],
            $data['commentsUrl'],
            $data['commitsUrl'],
            $data['compareUrl'],
            $data['contentsUrl'],
            $data['contributorsUrl'],
            $data['deploymentsUrl'],
            $data['downloadsUrl'],
            $data['eventsUrl'],
            $data['forksUrl'],
            $data['gitCommitsUrl'],
            $data['gitRefsUrl'],
            $data['gitTagsUrl'],
            $data['hooksUrl'],
            $data['issueCommentUrl'],
            $data['issueEventsUrl'],
            $data['issuesUrl'],
            $data['keysUrl'],
            $data['labelsUrl'],
            $data['languagesUrl'],
            $data['mergesUrl'],
            $data['milestonesUrl'],
            $data['notificationsUrl'],
            $data['pullsUrl'],
            $data['releasesUrl'],
            $data['stargazersUrl'],
            $data['statusesUrl'],
            $data['subscribersUrl'],
            $data['subscriptionUrl'],
            $data['tagsUrl'],
            $data['teamsUrl'],
            $data['treesUrl'],
            $data['svnUrl']
        );
    }
}
