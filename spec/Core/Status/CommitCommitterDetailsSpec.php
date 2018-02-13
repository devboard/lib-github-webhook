<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Status;

use DevboardLib\Generix\GravatarId;
use DevboardLib\GitHub\Account\AccountApiUrl;
use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountHtmlUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHubWebhook\Core\Status\CommitCommitterDetails;
use Git\Commit\CommitAuthor;
use PhpSpec\ObjectBehavior;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.ExcessiveParameterList)
 */
class CommitCommitterDetailsSpec extends ObjectBehavior
{
    public function let(
        AccountId $userId,
        AccountLogin $login,
        AccountType $type,
        AccountAvatarUrl $avatarUrl,
        GravatarId $gravatarId,
        AccountHtmlUrl $htmlUrl,
        AccountApiUrl $apiUrl
    ) {
        $this->beConstructedWith(
            $userId,
            $login,
            $type,
            $avatarUrl,
            $gravatarId,
            $htmlUrl,
            $apiUrl,
            $siteAdmin = false,
            $eventsUrl = 'https://api.github.com/users/octocat/events{/privacy}',
            $followersUrl = 'https://api.github.com/users/octocat/followers',
            $followingUrl = 'https://api.github.com/users/octocat/following{/other_user}',
            $gistsUrl = 'https://api.github.com/users/octocat/gists{/gist_id}',
            $organizationsUrl = 'https://api.github.com/users/octocat/orgs',
            $receivedEventsUrl = 'https://api.github.com/users/octocat/received_events',
            $reposUrl = 'https://api.github.com/users/octocat/repos',
            $starredUrl = 'https://api.github.com/users/octocat/starred{/owner}{/repo}',
            $subscriptionsUrl = 'https://api.github.com/users/octocat/subscriptions'
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CommitCommitterDetails::class);
        $this->shouldImplement(CommitAuthor::class);
    }

    public function it_exposes_user_id(AccountId $userId)
    {
        $this->getUserId()->shouldReturn($userId);
    }

    public function it_exposes_login(AccountLogin $login)
    {
        $this->getLogin()->shouldReturn($login);
    }

    public function it_exposes_type(AccountType $type)
    {
        $this->getType()->shouldReturn($type);
    }

    public function it_exposes_avatar_url(AccountAvatarUrl $avatarUrl)
    {
        $this->getAvatarUrl()->shouldReturn($avatarUrl);
    }

    public function it_exposes_gravatar_id(GravatarId $gravatarId)
    {
        $this->getGravatarId()->shouldReturn($gravatarId);
    }

    public function it_exposes_html_url(AccountHtmlUrl $htmlUrl)
    {
        $this->getHtmlUrl()->shouldReturn($htmlUrl);
    }

    public function it_exposes_api_url(AccountApiUrl $apiUrl)
    {
        $this->getApiUrl()->shouldReturn($apiUrl);
    }

    public function it_exposes_is_site_admin()
    {
        $this->isSiteAdmin()->shouldReturn(false);
    }

    public function it_exposes_events_url()
    {
        $this->getEventsUrl()->shouldReturn('https://api.github.com/users/octocat/events{/privacy}');
    }

    public function it_exposes_followers_url()
    {
        $this->getFollowersUrl()->shouldReturn('https://api.github.com/users/octocat/followers');
    }

    public function it_exposes_following_url()
    {
        $this->getFollowingUrl()->shouldReturn('https://api.github.com/users/octocat/following{/other_user}');
    }

    public function it_exposes_gists_url()
    {
        $this->getGistsUrl()->shouldReturn('https://api.github.com/users/octocat/gists{/gist_id}');
    }

    public function it_exposes_organizations_url()
    {
        $this->getOrganizationsUrl()->shouldReturn('https://api.github.com/users/octocat/orgs');
    }

    public function it_exposes_received_events_url()
    {
        $this->getReceivedEventsUrl()->shouldReturn('https://api.github.com/users/octocat/received_events');
    }

    public function it_exposes_repos_url()
    {
        $this->getReposUrl()->shouldReturn('https://api.github.com/users/octocat/repos');
    }

    public function it_exposes_starred_url()
    {
        $this->getStarredUrl()->shouldReturn('https://api.github.com/users/octocat/starred{/owner}{/repo}');
    }

    public function it_exposes_subscriptions_url()
    {
        $this->getSubscriptionsUrl()->shouldReturn('https://api.github.com/users/octocat/subscriptions');
    }

    public function it_can_be_serialized(
        AccountId $userId,
        AccountLogin $login,
        AccountType $type,
        AccountAvatarUrl $avatarUrl,
        GravatarId $gravatarId,
        AccountHtmlUrl $htmlUrl,
        AccountApiUrl $apiUrl
    ) {
        $userId->serialize()->shouldBeCalled()->willReturn(583231);
        $login->serialize()->shouldBeCalled()->willReturn('octocat');
        $type->serialize()->shouldBeCalled()->willReturn('User');
        $avatarUrl->serialize()->shouldBeCalled()->willReturn('https://avatars3.githubusercontent.com/u/583231?v=4');
        $gravatarId->serialize()->shouldBeCalled()->willReturn('');
        $htmlUrl->serialize()->shouldBeCalled()->willReturn('https://github.com/octocat');
        $apiUrl->serialize()->shouldBeCalled()->willReturn('https://api.github.com/users/octocat');
        $this->serialize()->shouldReturn(
            [
                'userId'            => 583231,
                'login'             => 'octocat',
                'type'              => 'User',
                'avatarUrl'         => 'https://avatars3.githubusercontent.com/u/583231?v=4',
                'gravatarId'        => '',
                'htmlUrl'           => 'https://github.com/octocat',
                'apiUrl'            => 'https://api.github.com/users/octocat',
                'siteAdmin'         => false,
                'eventsUrl'         => 'https://api.github.com/users/octocat/events{/privacy}',
                'followersUrl'      => 'https://api.github.com/users/octocat/followers',
                'followingUrl'      => 'https://api.github.com/users/octocat/following{/other_user}',
                'gistsUrl'          => 'https://api.github.com/users/octocat/gists{/gist_id}',
                'organizationsUrl'  => 'https://api.github.com/users/octocat/orgs',
                'receivedEventsUrl' => 'https://api.github.com/users/octocat/received_events',
                'reposUrl'          => 'https://api.github.com/users/octocat/repos',
                'starredUrl'        => 'https://api.github.com/users/octocat/starred{/owner}{/repo}',
                'subscriptionsUrl'  => 'https://api.github.com/users/octocat/subscriptions',
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'userId'            => 583231,
            'login'             => 'octocat',
            'type'              => 'User',
            'avatarUrl'         => 'https://avatars3.githubusercontent.com/u/583231?v=4',
            'gravatarId'        => '',
            'htmlUrl'           => 'https://github.com/octocat',
            'apiUrl'            => 'https://api.github.com/users/octocat',
            'siteAdmin'         => false,
            'eventsUrl'         => 'https://api.github.com/users/octocat/events{/privacy}',
            'followersUrl'      => 'https://api.github.com/users/octocat/followers',
            'followingUrl'      => 'https://api.github.com/users/octocat/following{/other_user}',
            'gistsUrl'          => 'https://api.github.com/users/octocat/gists{/gist_id}',
            'organizationsUrl'  => 'https://api.github.com/users/octocat/orgs',
            'receivedEventsUrl' => 'https://api.github.com/users/octocat/received_events',
            'reposUrl'          => 'https://api.github.com/users/octocat/repos',
            'starredUrl'        => 'https://api.github.com/users/octocat/starred{/owner}{/repo}',
            'subscriptionsUrl'  => 'https://api.github.com/users/octocat/subscriptions',
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(CommitCommitterDetails::class);
    }
}
