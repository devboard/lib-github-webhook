<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\Push;

use DevboardLib\GitHub\Account\AccountAvatarUrl;
use DevboardLib\GitHub\Account\AccountId;
use DevboardLib\GitHub\Account\AccountLogin;
use DevboardLib\GitHub\GitHubAccount;
use DevboardLib\GitHubWebhook\Core\Push\Organization;
use PhpSpec\ObjectBehavior;

class OrganizationSpec extends ObjectBehavior
{
    public function let(AccountId $id, AccountLogin $login, AccountAvatarUrl $avatarUrl)
    {
        $this->beConstructedWith(
            $id,
            $login,
            $avatarUrl,
            $description = 'Zagreb PHP Meetup',
            $reposUrl = 'https://api.github.com/orgs/zgphp/repos',
            $issuesUrl = 'https://api.github.com/orgs/zgphp/issues',
            $eventsUrl = 'https://api.github.com/orgs/zgphp/events',
            $hooksUrl = 'https://api.github.com/orgs/zgphp/hooks',
            $membersUrl = 'https://api.github.com/orgs/zgphp/members{/member}',
            $publicMembersUrl = 'https://api.github.com/orgs/zgphp/public_members{/member}'
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(Organization::class);
        $this->shouldImplement(GitHubAccount::class);
    }

    public function it_exposes_id(AccountId $id)
    {
        $this->getId()->shouldReturn($id);
    }

    public function it_exposes_login(AccountLogin $login)
    {
        $this->getLogin()->shouldReturn($login);
    }

    public function it_exposes_avatar_url(AccountAvatarUrl $avatarUrl)
    {
        $this->getAvatarUrl()->shouldReturn($avatarUrl);
    }

    public function it_exposes_description()
    {
        $this->getDescription()->shouldReturn('Zagreb PHP Meetup');
    }

    public function it_exposes_repos_url()
    {
        $this->getReposUrl()->shouldReturn('https://api.github.com/orgs/zgphp/repos');
    }

    public function it_exposes_issues_url()
    {
        $this->getIssuesUrl()->shouldReturn('https://api.github.com/orgs/zgphp/issues');
    }

    public function it_exposes_events_url()
    {
        $this->getEventsUrl()->shouldReturn('https://api.github.com/orgs/zgphp/events');
    }

    public function it_exposes_hooks_url()
    {
        $this->getHooksUrl()->shouldReturn('https://api.github.com/orgs/zgphp/hooks');
    }

    public function it_exposes_members_url()
    {
        $this->getMembersUrl()->shouldReturn('https://api.github.com/orgs/zgphp/members{/member}');
    }

    public function it_exposes_public_members_url()
    {
        $this->getPublicMembersUrl()->shouldReturn('https://api.github.com/orgs/zgphp/public_members{/member}');
    }

    public function it_can_be_serialized(AccountId $id, AccountLogin $login, AccountAvatarUrl $avatarUrl)
    {
        $id->serialize()->shouldBeCalled()->willReturn(3259285);
        $login->serialize()->shouldBeCalled()->willReturn('zgphp');
        $avatarUrl->serialize()->shouldBeCalled()->willReturn('https://avatars3.githubusercontent.com/u/3259285?v=4');
        $this->serialize()->shouldReturn(
            [
                'id'               => 3259285,
                'login'            => 'zgphp',
                'avatarUrl'        => 'https://avatars3.githubusercontent.com/u/3259285?v=4',
                'description'      => 'Zagreb PHP Meetup',
                'reposUrl'         => 'https://api.github.com/orgs/zgphp/repos',
                'issuesUrl'        => 'https://api.github.com/orgs/zgphp/issues',
                'eventsUrl'        => 'https://api.github.com/orgs/zgphp/events',
                'hooksUrl'         => 'https://api.github.com/orgs/zgphp/hooks',
                'membersUrl'       => 'https://api.github.com/orgs/zgphp/members{/member}',
                'publicMembersUrl' => 'https://api.github.com/orgs/zgphp/public_members{/member}',
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'id'               => 3259285,
            'login'            => 'zgphp',
            'avatarUrl'        => 'https://avatars3.githubusercontent.com/u/3259285?v=4',
            'description'      => 'Zagreb PHP Meetup',
            'reposUrl'         => 'https://api.github.com/orgs/zgphp/repos',
            'issuesUrl'        => 'https://api.github.com/orgs/zgphp/issues',
            'eventsUrl'        => 'https://api.github.com/orgs/zgphp/events',
            'hooksUrl'         => 'https://api.github.com/orgs/zgphp/hooks',
            'membersUrl'       => 'https://api.github.com/orgs/zgphp/members{/member}',
            'publicMembersUrl' => 'https://api.github.com/orgs/zgphp/public_members{/member}',
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(Organization::class);
    }
}
