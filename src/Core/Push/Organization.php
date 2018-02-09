<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\GitHub\Account\AccountApiUrl;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\GitHubAccount;

/**
 * @see \spec\DevboardLib\GitHubWebhook\Core\Push\OrganizationSpec
 * @see \Tests\DevboardLib\GitHubWebhook\Core\Push\OrganizationTest
 */
class Organization implements GitHubAccount
{
    /** @var AccountId */
    private $id;

    /** @var AccountLogin */
    private $login;

    /** @var AccountAvatarUrl */
    private $avatarUrl;

    /** @var string */
    private $description;

    /** @var AccountApiUrl */
    private $apiUrl;

    /** @var string */
    private $reposUrl;

    /** @var string */
    private $issuesUrl;

    /** @var string */
    private $eventsUrl;

    /** @var string */
    private $hooksUrl;

    /** @var string */
    private $membersUrl;

    /** @var string */
    private $publicMembersUrl;

    /** @SuppressWarnings(PHPMD.ExcessiveParameterList) */
    public function __construct(
        AccountId $id,
        AccountLogin $login,
        AccountAvatarUrl $avatarUrl,
        string $description,
        AccountApiUrl $apiUrl,
        string $reposUrl,
        string $issuesUrl,
        string $eventsUrl,
        string $hooksUrl,
        string $membersUrl,
        string $publicMembersUrl
    ) {
        $this->id               = $id;
        $this->login            = $login;
        $this->avatarUrl        = $avatarUrl;
        $this->description      = $description;
        $this->apiUrl           = $apiUrl;
        $this->reposUrl         = $reposUrl;
        $this->issuesUrl        = $issuesUrl;
        $this->eventsUrl        = $eventsUrl;
        $this->hooksUrl         = $hooksUrl;
        $this->membersUrl       = $membersUrl;
        $this->publicMembersUrl = $publicMembersUrl;
    }

    public function getId(): AccountId
    {
        return $this->id;
    }

    public function getLogin(): AccountLogin
    {
        return $this->login;
    }

    public function getAvatarUrl(): AccountAvatarUrl
    {
        return $this->avatarUrl;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getApiUrl(): AccountApiUrl
    {
        return $this->apiUrl;
    }

    public function getReposUrl(): string
    {
        return $this->reposUrl;
    }

    public function getIssuesUrl(): string
    {
        return $this->issuesUrl;
    }

    public function getEventsUrl(): string
    {
        return $this->eventsUrl;
    }

    public function getHooksUrl(): string
    {
        return $this->hooksUrl;
    }

    public function getMembersUrl(): string
    {
        return $this->membersUrl;
    }

    public function getPublicMembersUrl(): string
    {
        return $this->publicMembersUrl;
    }

    public function serialize(): array
    {
        return [
            'id'               => $this->id->serialize(),
            'login'            => $this->login->serialize(),
            'avatarUrl'        => $this->avatarUrl->serialize(),
            'description'      => $this->description,
            'apiUrl'           => $this->apiUrl->serialize(),
            'reposUrl'         => $this->reposUrl,
            'issuesUrl'        => $this->issuesUrl,
            'eventsUrl'        => $this->eventsUrl,
            'hooksUrl'         => $this->hooksUrl,
            'membersUrl'       => $this->membersUrl,
            'publicMembersUrl' => $this->publicMembersUrl,
        ];
    }

    public static function deserialize(array $data): self
    {
        return new self(
            AccountId::deserialize($data['id']),
            AccountLogin::deserialize($data['login']),
            AccountAvatarUrl::deserialize($data['avatarUrl']),
            $data['description'],
            AccountApiUrl::deserialize($data['apiUrl']),
            $data['reposUrl'],
            $data['issuesUrl'],
            $data['eventsUrl'],
            $data['hooksUrl'],
            $data['membersUrl'],
            $data['publicMembersUrl']
        );
    }
}
