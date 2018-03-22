<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook\Core\PullRequestReview;

use DevboardLib\GitHub\PullRequest\PullRequestApiUrl;
use DevboardLib\GitHub\PullRequestReview\PullRequestReviewHtmlUrl;
use DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReviewUrls;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DevboardLib\GitHubWebhook\Core\PullRequestReview\PullRequestReviewUrls
 * @group  todo
 */
class PullRequestReviewUrlsTest extends TestCase
{
    /** @var PullRequestReviewHtmlUrl */
    private $htmlUrl;

    /** @var PullRequestApiUrl */
    private $pullRequestApiUrl;

    /** @var PullRequestReviewUrls */
    private $sut;

    public function setUp()
    {
        $this->htmlUrl           = new PullRequestReviewHtmlUrl('htmlUrl');
        $this->pullRequestApiUrl = new PullRequestApiUrl('apiUrl');
        $this->sut               = new PullRequestReviewUrls($this->htmlUrl, $this->pullRequestApiUrl);
    }

    public function testGetHtmlUrl()
    {
        self::assertSame($this->htmlUrl, $this->sut->getHtmlUrl());
    }

    public function testGetValue()
    {
        self::assertSame($this->pullRequestApiUrl, $this->sut->getValue());
    }

    public function testGetPullRequestApiUrl()
    {
        self::assertSame($this->pullRequestApiUrl, $this->sut->getPullRequestApiUrl());
    }

    public function testSerialize()
    {
        $expected = ['htmlUrl' => 'htmlUrl', 'pullRequestApiUrl' => 'apiUrl'];

        self::assertSame($expected, $this->sut->serialize());
    }

    public function testDeserialize()
    {
        $serialized = json_encode($this->sut->serialize());
        self::assertEquals($this->sut, PullRequestReviewUrls::deserialize(json_decode($serialized, true)));
    }
}
