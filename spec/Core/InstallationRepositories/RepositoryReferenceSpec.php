<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\InstallationRepositories;

use DevboardLib\GitHub\Repo\RepoFullName;
use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReference;
use PhpSpec\ObjectBehavior;

class RepositoryReferenceSpec extends ObjectBehavior
{
    public function let(RepoId $id, RepoFullName $fullName)
    {
        $this->beConstructedWith($id, $fullName);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RepositoryReference::class);
    }

    public function it_exposes_id(RepoId $id)
    {
        $this->getId()->shouldReturn($id);
    }

    public function it_exposes_full_name(RepoFullName $fullName)
    {
        $this->getFullName()->shouldReturn($fullName);
    }

    public function it_can_be_serialized(RepoId $id, RepoFullName $fullName)
    {
        $id->serialize()->shouldBeCalled()->willReturn(64778136);
        $fullName->serialize()->shouldBeCalled()->willReturn(['owner' => 'value', 'repoName' => 'name']);
        $this->serialize()->shouldReturn(['id' => 64778136, 'fullName' => ['owner' => 'value', 'repoName' => 'name']]);
    }

    public function it_can_be_deserialized()
    {
        $input = ['id' => 64778136, 'fullName' => ['owner' => 'value', 'repoName' => 'name']];

        $this->deserialize($input)->shouldReturnAnInstanceOf(RepositoryReference::class);
    }
}
