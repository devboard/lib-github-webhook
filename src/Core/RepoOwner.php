<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core;

use DevboardLib\Generix\GravatarId;
use DevboardLib\GitHub\Account\AccountApiUrl;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountHtmlUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\RepoOwnerSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\RepoOwnerTest
 */
class RepoOwner
{
    /** @var AccountId */
    private $userId;

    /** @var AccountLogin */
    private $login;

    /** @var AccountType */
    private $type;

    /** @var AccountAvatarUrl */
    private $avatarUrl;

    /** @var GravatarId */
    private $gravatarId;

    /** @var AccountHtmlUrl */
    private $htmlUrl;

    /** @var AccountApiUrl */
    private $apiUrl;

    /** @var bool */
    private $siteAdmin;

    /** @var string */
    private $name;

    /** @var string|null */
    private $email;

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
        AccountId $userId,
        AccountLogin $login,
        AccountType $type,
        AccountAvatarUrl $avatarUrl,
        GravatarId $gravatarId,
        AccountHtmlUrl $htmlUrl,
        AccountApiUrl $apiUrl,
        bool $siteAdmin,
        string $name,
        ?string $email,
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
        $this->name              = $name;
        $this->email             = $email;
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

    public function getUserId(): AccountId
    {
        return $this->userId;
    }

    public function getLogin(): AccountLogin
    {
        return $this->login;
    }

    public function getType(): AccountType
    {
        return $this->type;
    }

    public function getAvatarUrl(): AccountAvatarUrl
    {
        return $this->avatarUrl;
    }

    public function getGravatarId(): GravatarId
    {
        return $this->gravatarId;
    }

    public function getHtmlUrl(): AccountHtmlUrl
    {
        return $this->htmlUrl;
    }

    public function getApiUrl(): AccountApiUrl
    {
        return $this->apiUrl;
    }

    public function isSiteAdmin(): bool
    {
        return $this->siteAdmin;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
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

    public function serialize(): array
    {
        return [
            'userId'            => $this->userId->serialize(),
            'login'             => $this->login->serialize(),
            'type'              => $this->type->serialize(),
            'avatarUrl'         => $this->avatarUrl->serialize(),
            'gravatarId'        => $this->gravatarId->serialize(),
            'htmlUrl'           => $this->htmlUrl->serialize(),
            'apiUrl'            => $this->apiUrl->serialize(),
            'siteAdmin'         => $this->siteAdmin,
            'name'              => $this->name,
            'email'             => $this->email,
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
        return new self(
            AccountId::deserialize($data['userId']),
            AccountLogin::deserialize($data['login']),
            AccountType::deserialize($data['type']),
            AccountAvatarUrl::deserialize($data['avatarUrl']),
            GravatarId::deserialize($data['gravatarId']),
            AccountHtmlUrl::deserialize($data['htmlUrl']),
            AccountApiUrl::deserialize($data['apiUrl']),
            $data['siteAdmin'],
            $data['name'],
            $data['email'],
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
