<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core\InstallationRepositories;

use DevboardLib\GitHub\Repo\RepoId;
use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReference;
use DevboardLib\GitHubWebhook\Core\InstallationRepositories\RepositoryReferenceCollection;
use PhpSpec\ObjectBehavior;

class RepositoryReferenceCollectionSpec extends ObjectBehavior
{
    public function let(RepositoryReference $repositoryReference)
    {
        $this->beConstructedWith($elements = [$repositoryReference]);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RepositoryReferenceCollection::class);
    }

    public function it_exposes_elements(RepositoryReference $repositoryReference)
    {
        $this->toArray()->shouldReturn([$repositoryReference]);
    }

    public function it_exposes_number_of_elements_in_collection()
    {
        $this->count()->shouldReturn(1);
    }

    public function it_supports_add_new_element(RepositoryReference $anotherRepositoryReference)
    {
        $this->add($anotherRepositoryReference);
        $this->count()->shouldReturn(2);
    }

    public function it_knows_if_element_is_in_collection(RepositoryReference $repositoryReference, RepoId $repoId)
    {
        $repositoryReference->getId()->shouldBeCalled()->willReturn($repoId);
        $this->has($repoId)->shouldReturn(true);
    }

    public function it_can_return_element_from_collection_by_given_id(
        RepositoryReference $repositoryReference, RepoId $repoId
    ) {
        $repositoryReference->getId()->shouldBeCalled()->willReturn($repoId);
        $this->get($repoId)->shouldReturn($repositoryReference);
    }
}
