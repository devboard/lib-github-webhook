<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\PullRequest;

use DevboardLib\GitHub\Account\AccountType;
use DevboardLib\GitHub\User\UserAvatarUrl;
use DevboardLib\GitHub\User\UserId;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\PullRequest\PullRequestRequestedReviewer;
use PhpSpec\ObjectBehavior;

class PullRequestRequestedReviewerSpec extends ObjectBehavior
{
    public function let(UserId $userId, UserLogin $login, AccountType $type, UserAvatarUrl $avatarUrl)
    {
        $this->beConstructedWith(
            $userId,
            $login,
            $type,
            $avatarUrl,
            $siteAdmin = false,
            $eventsUrl = 'https://api.github.com/users/baxterthehacker/events{/privacy}',
            $followersUrl = 'https://api.github.com/users/baxterthehacker/followers',
            $followingUrl = 'https://api.github.com/users/baxterthehacker/following{/other_user}',
            $gistsUrl = 'https://api.github.com/users/baxterthehacker/gists{/gist_id}',
            $organizationsUrl = 'https://api.github.com/users/baxterthehacker/orgs',
            $receivedEventsUrl = 'https://api.github.com/users/baxterthehacker/received_events',
            $reposUrl = 'https://api.github.com/users/baxterthehacker/repos',
            $starredUrl = 'https://api.github.com/users/baxterthehacker/starred{/owner}{/repo}',
            $subscriptionsUrl = 'https://api.github.com/users/baxterthehacker/subscriptions'
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(PullRequestRequestedReviewer::class);
    }

    public function it_exposes_user_id(UserId $userId)
    {
        $this->getUserId()->shouldReturn($userId);
    }

    public function it_exposes_login(UserLogin $login)
    {
        $this->getLogin()->shouldReturn($login);
    }

    public function it_exposes_type(AccountType $type)
    {
        $this->getType()->shouldReturn($type);
    }

    public function it_exposes_avatar_url(UserAvatarUrl $avatarUrl)
    {
        $this->getAvatarUrl()->shouldReturn($avatarUrl);
    }

    public function it_exposes_is_site_admin()
    {
        $this->isSiteAdmin()->shouldReturn(false);
    }

    public function it_exposes_events_url()
    {
        $this->getEventsUrl()->shouldReturn('https://api.github.com/users/baxterthehacker/events{/privacy}');
    }

    public function it_exposes_followers_url()
    {
        $this->getFollowersUrl()->shouldReturn('https://api.github.com/users/baxterthehacker/followers');
    }

    public function it_exposes_following_url()
    {
        $this->getFollowingUrl()->shouldReturn('https://api.github.com/users/baxterthehacker/following{/other_user}');
    }

    public function it_exposes_gists_url()
    {
        $this->getGistsUrl()->shouldReturn('https://api.github.com/users/baxterthehacker/gists{/gist_id}');
    }

    public function it_exposes_organizations_url()
    {
        $this->getOrganizationsUrl()->shouldReturn('https://api.github.com/users/baxterthehacker/orgs');
    }

    public function it_exposes_received_events_url()
    {
        $this->getReceivedEventsUrl()->shouldReturn('https://api.github.com/users/baxterthehacker/received_events');
    }

    public function it_exposes_repos_url()
    {
        $this->getReposUrl()->shouldReturn('https://api.github.com/users/baxterthehacker/repos');
    }

    public function it_exposes_starred_url()
    {
        $this->getStarredUrl()->shouldReturn('https://api.github.com/users/baxterthehacker/starred{/owner}{/repo}');
    }

    public function it_exposes_subscriptions_url()
    {
        $this->getSubscriptionsUrl()->shouldReturn('https://api.github.com/users/baxterthehacker/subscriptions');
    }

    public function it_can_be_serialized(
        UserId $userId, UserLogin $login, AccountType $type, UserAvatarUrl $avatarUrl
    ) {
        $userId->serialize()->shouldBeCalled()->willReturn(6752317);
        $login->serialize()->shouldBeCalled()->willReturn('baxterthehacker');
        $type->serialize()->shouldBeCalled()->willReturn('User');
        $avatarUrl->serialize()->shouldBeCalled()->willReturn('https://avatars.githubusercontent.com/u/6752317?v=3');
        $this->serialize()->shouldReturn(
            [
                'userId'            => 6752317,
                'login'             => 'baxterthehacker',
                'type'              => 'User',
                'avatarUrl'         => 'https://avatars.githubusercontent.com/u/6752317?v=3',
                'siteAdmin'         => false,
                'eventsUrl'         => 'https://api.github.com/users/baxterthehacker/events{/privacy}',
                'followersUrl'      => 'https://api.github.com/users/baxterthehacker/followers',
                'followingUrl'      => 'https://api.github.com/users/baxterthehacker/following{/other_user}',
                'gistsUrl'          => 'https://api.github.com/users/baxterthehacker/gists{/gist_id}',
                'organizationsUrl'  => 'https://api.github.com/users/baxterthehacker/orgs',
                'receivedEventsUrl' => 'https://api.github.com/users/baxterthehacker/received_events',
                'reposUrl'          => 'https://api.github.com/users/baxterthehacker/repos',
                'starredUrl'        => 'https://api.github.com/users/baxterthehacker/starred{/owner}{/repo}',
                'subscriptionsUrl'  => 'https://api.github.com/users/baxterthehacker/subscriptions',
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'userId'            => 6752317,
            'login'             => 'baxterthehacker',
            'type'              => 'User',
            'avatarUrl'         => 'https://avatars.githubusercontent.com/u/6752317?v=3',
            'siteAdmin'         => false,
            'eventsUrl'         => 'https://api.github.com/users/baxterthehacker/events{/privacy}',
            'followersUrl'      => 'https://api.github.com/users/baxterthehacker/followers',
            'followingUrl'      => 'https://api.github.com/users/baxterthehacker/following{/other_user}',
            'gistsUrl'          => 'https://api.github.com/users/baxterthehacker/gists{/gist_id}',
            'organizationsUrl'  => 'https://api.github.com/users/baxterthehacker/orgs',
            'receivedEventsUrl' => 'https://api.github.com/users/baxterthehacker/received_events',
            'reposUrl'          => 'https://api.github.com/users/baxterthehacker/repos',
            'starredUrl'        => 'https://api.github.com/users/baxterthehacker/starred{/owner}{/repo}',
            'subscriptionsUrl'  => 'https://api.github.com/users/baxterthehacker/subscriptions',
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(PullRequestRequestedReviewer::class);
    }
}
