<?php

declare(strict_types=1);

namespace spec\DevboardLib\GitHubWebhook\Core;

use DevboardLib\GitHubWebhook\Core\RepoAdditionalDetails;
use PhpSpec\ObjectBehavior;

class RepoAdditionalDetailsSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith(
            $license = 'master',
            $forksCount = 0,
            $hasDownloads = false,
            $hasIssues = false,
            $hasPages = false,
            $hasProjects = false,
            $hasWiki = false
        );
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RepoAdditionalDetails::class);
    }

    public function it_exposes_license()
    {
        $this->getLicense()->shouldReturn('master');
    }

    public function it_exposes_forks_count()
    {
        $this->getForksCount()->shouldReturn(0);
    }

    public function it_exposes_is_has_downloads()
    {
        $this->isHasDownloads()->shouldReturn(false);
    }

    public function it_exposes_is_has_issues()
    {
        $this->isHasIssues()->shouldReturn(false);
    }

    public function it_exposes_is_has_pages()
    {
        $this->isHasPages()->shouldReturn(false);
    }

    public function it_exposes_is_has_projects()
    {
        $this->isHasProjects()->shouldReturn(false);
    }

    public function it_exposes_is_has_wiki()
    {
        $this->isHasWiki()->shouldReturn(false);
    }

    public function it_has_license()
    {
        $this->hasLicense()->shouldReturn(true);
    }

    public function it_can_be_serialized()
    {
        $this->serialize()->shouldReturn(
            [
                'license'      => 'master',
                'forksCount'   => 0,
                'hasDownloads' => false,
                'hasIssues'    => false,
                'hasPages'     => false,
                'hasProjects'  => false,
                'hasWiki'      => false,
            ]
        );
    }

    public function it_can_be_deserialized()
    {
        $input = [
            'license'      => 'master',
            'forksCount'   => 0,
            'hasDownloads' => false,
            'hasIssues'    => false,
            'hasPages'     => false,
            'hasProjects'  => false,
            'hasWiki'      => false,
        ];

        $this->deserialize($input)->shouldReturnAnInstanceOf(RepoAdditionalDetails::class);
    }
}
