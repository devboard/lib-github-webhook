<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\Generix\GravatarId;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\User\UserApiUrl;
use DevboardLib\GitHub\User\UserAvatarUrl;
use DevboardLib\GitHub\User\UserHtmlUrl;
use DevboardLib\GitHub\User\UserId;
use DevboardLib\GitHub\User\UserLogin;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedReviewerSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedReviewerTest
 */
class PullRequestRequestedReviewer
{
    /** @var UserId */
    private $userId;

    /** @var UserLogin */
    private $login;

    /** @var AccountType */
    private $type;

    /** @var UserAvatarUrl */
    private $avatarUrl;

    /** @var GravatarId|null */
    private $gravatarId;

    /** @var UserHtmlUrl */
    private $htmlUrl;

    /** @var UserApiUrl */
    private $apiUrl;

    /** @var bool */
    private $siteAdmin;

    /** @var string */
    private $eventsUrl;

    /** @var string */
    private $followersUrl;

    /** @var string */
    private $followingUrl;

    /** @var string */
    private $gistsUrl;

    /** @var string */
    private $organizationsUrl;

    /** @var string */
    private $receivedEventsUrl;

    /** @var string */
    private $reposUrl;

    /** @var string */
    private $starredUrl;

    /** @var string */
    private $subscriptionsUrl;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        UserId $userId,
        UserLogin $login,
        AccountType $type,
        UserAvatarUrl $avatarUrl,
        ?GravatarId $gravatarId,
        UserHtmlUrl $htmlUrl,
        UserApiUrl $apiUrl,
        bool $siteAdmin,
        string $eventsUrl,
        string $followersUrl,
        string $followingUrl,
        string $gistsUrl,
        string $organizationsUrl,
        string $receivedEventsUrl,
        string $reposUrl,
        string $starredUrl,
        string $subscriptionsUrl
    ) {
        $this->userId            = $userId;
        $this->login             = $login;
        $this->type              = $type;
        $this->avatarUrl         = $avatarUrl;
        $this->gravatarId        = $gravatarId;
        $this->htmlUrl           = $htmlUrl;
        $this->apiUrl            = $apiUrl;
        $this->siteAdmin         = $siteAdmin;
        $this->eventsUrl         = $eventsUrl;
        $this->followersUrl      = $followersUrl;
        $this->followingUrl      = $followingUrl;
        $this->gistsUrl          = $gistsUrl;
        $this->organizationsUrl  = $organizationsUrl;
        $this->receivedEventsUrl = $receivedEventsUrl;
        $this->reposUrl          = $reposUrl;
        $this->starredUrl        = $starredUrl;
        $this->subscriptionsUrl  = $subscriptionsUrl;
    }

    public function getUserId(): UserId
    {
        return $this->userId;
    }

    public function getLogin(): UserLogin
    {
        return $this->login;
    }

    public function getType(): AccountType
    {
        return $this->type;
    }

    public function getAvatarUrl(): UserAvatarUrl
    {
        return $this->avatarUrl;
    }

    public function getGravatarId(): ?GravatarId
    {
        return $this->gravatarId;
    }

    public function getHtmlUrl(): UserHtmlUrl
    {
        return $this->htmlUrl;
    }

    public function getApiUrl(): UserApiUrl
    {
        return $this->apiUrl;
    }

    public function isSiteAdmin(): bool
    {
        return $this->siteAdmin;
    }

    public function getEventsUrl(): string
    {
        return $this->eventsUrl;
    }

    public function getFollowersUrl(): string
    {
        return $this->followersUrl;
    }

    public function getFollowingUrl(): string
    {
        return $this->followingUrl;
    }

    public function getGistsUrl(): string
    {
        return $this->gistsUrl;
    }

    public function getOrganizationsUrl(): string
    {
        return $this->organizationsUrl;
    }

    public function getReceivedEventsUrl(): string
    {
        return $this->receivedEventsUrl;
    }

    public function getReposUrl(): string
    {
        return $this->reposUrl;
    }

    public function getStarredUrl(): string
    {
        return $this->starredUrl;
    }

    public function getSubscriptionsUrl(): string
    {
        return $this->subscriptionsUrl;
    }

    public function hasGravatarId(): bool
    {
        if (null === $this->gravatarId) {
            return false;
        }

        return true;
    }

    public function serialize(): array
    {
        if (null === $this->gravatarId) {
            $gravatarId = null;
        } else {
            $gravatarId = $this->gravatarId->serialize();
        }

        return [
            'userId'            => $this->userId->serialize(),
            'login'             => $this->login->serialize(),
            'type'              => $this->type->serialize(),
            'avatarUrl'         => $this->avatarUrl->serialize(),
            'gravatarId'        => $gravatarId,
            'htmlUrl'           => $this->htmlUrl->serialize(),
            'apiUrl'            => $this->apiUrl->serialize(),
            'siteAdmin'         => $this->siteAdmin,
            'eventsUrl'         => $this->eventsUrl,
            'followersUrl'      => $this->followersUrl,
            'followingUrl'      => $this->followingUrl,
            'gistsUrl'          => $this->gistsUrl,
            'organizationsUrl'  => $this->organizationsUrl,
            'receivedEventsUrl' => $this->receivedEventsUrl,
            'reposUrl'          => $this->reposUrl,
            'starredUrl'        => $this->starredUrl,
            'subscriptionsUrl'  => $this->subscriptionsUrl,
        ];
    }

    public static function deserialize(array $data): self
    {
        if (null === $data['gravatarId']) {
            $gravatarId = null;
        } else {
            $gravatarId = GravatarId::deserialize($data['gravatarId']);
        }

        return new self(
            UserId::deserialize($data['userId']),
            UserLogin::deserialize($data['login']),
            AccountType::deserialize($data['type']),
            UserAvatarUrl::deserialize($data['avatarUrl']),
            $gravatarId,
            UserHtmlUrl::deserialize($data['htmlUrl']),
            UserApiUrl::deserialize($data['apiUrl']),
            $data['siteAdmin'],
            $data['eventsUrl'],
            $data['followersUrl'],
            $data['followingUrl'],
            $data['gistsUrl'],
            $data['organizationsUrl'],
            $data['receivedEventsUrl'],
            $data['reposUrl'],
            $data['starredUrl'],
            $data['subscriptionsUrl']
        );
    }
}
