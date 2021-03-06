<?php

declare(strict_types=1);

namespace Tests\DevboardLib\GitHubWebhook;

use Exception;
use Generator;
use Symfony\Component\Finder\Finder;

class StagingDataProvider
{
    /**
     * @var string
     */
    private $basePath;

    public function __construct(string $basePath = null)
    {
        if (null === $basePath) {
            //$basePath = '/work/projects/devboard/docker/github-data-dump/';
            //$basePath = '/work/projects/devboard/lib/lib-github-webhook/tmp/';
            $basePath = '/work/projects/devboard/examples/version1/';
        }

        $this->basePath = $basePath;
    }

    public function getGitHubInstalationEventData(): Generator
    {
        if (true === is_dir($this->basePath)) {
            foreach ($this->loadAllFilesMatchingEventType('installation') as $file) {
                yield $this->getDecodedJsonFromFile($file->getRealPath());
            }
        }
    }

    public function getGitHubInstalationRepositoriesEventData(): Generator
    {
        if (true === is_dir($this->basePath)) {
            foreach ($this->loadAllFilesMatchingEventType('installation_repositories') as $file) {
                yield $this->getDecodedJsonFromFile($file->getRealPath());
            }
        }
    }

    public function getGitHubIssueData(): Generator
    {
        if (true === is_dir($this->basePath)) {
            foreach ($this->loadAllFilesMatchingEventType('issues') as $file) {
                yield $this->getDecodedJsonFromFile($file->getRealPath());
            }
        }
    }

    public function getGitHubIssueCommentData(): Generator
    {
        if (true === is_dir($this->basePath)) {
            foreach ($this->loadAllFilesMatchingEventType('issue_comment') as $file) {
                yield $this->getDecodedJsonFromFile($file->getRealPath());
            }
        }
    }

    public function getGitHubLabelData(): Generator
    {
        if (true === is_dir($this->basePath)) {
            foreach ($this->loadAllFilesMatchingEventType('label') as $file) {
                yield $this->getDecodedJsonFromFile($file->getRealPath());
            }
        }
    }

    public function getGitHubPullRequestData(): Generator
    {
        if (true === is_dir($this->basePath)) {
            foreach ($this->loadAllFilesMatchingEventType('pull_request') as $file) {
                yield $this->getDecodedJsonFromFile($file->getRealPath());
            }
        }
    }

    public function getGitHubPullRequestReviewData(): Generator
    {
        if (true === is_dir($this->basePath)) {
            foreach ($this->loadAllFilesMatchingEventType('pull_request_review') as $file) {
                yield $this->getDecodedJsonFromFile($file->getRealPath());
            }
        }
    }

    public function getGitHubPushEventData(): Generator
    {
        if (true === is_dir($this->basePath)) {
            foreach ($this->loadAllFilesMatchingEventType('push') as $file) {
                yield $this->getDecodedJsonFromFile($file->getRealPath());
            }
        }
    }

    public function getGitHubStatusData(): Generator
    {
        if (true === is_dir($this->basePath)) {
            foreach ($this->loadAllFilesMatchingEventType('status') as $file) {
                yield $this->getDecodedJsonFromFile($file->getRealPath());
            }
        }
    }

    public function getAllGitHubEventJsonData(): Generator
    {
        if (true === is_dir($this->basePath)) {
            foreach ($this->loadAllFilesMatchingEventType('_all2') as $file) {
                yield ['file' => $file->getRealPath(), 'data' => $this->getDecodedJsonFromFile($file->getRealPath())];
            }
        }
    }

    private function getDecodedJsonFromFile(string $path): array
    {
        $content = file_get_contents($path);

        $data = json_decode($content, true);

        $jsonLastError = json_last_error();

        if (JSON_ERROR_NONE !== $jsonLastError) {
            throw new Exception('ERR: '.$jsonLastError.' happened on '.$path);
        }
        if (null === $data) {
            throw new Exception('ERR: null data on '.$path);
        }

        return $data;
    }

    private function loadAllFilesMatchingEventType(string $eventType): Finder
    {
        $finder = new Finder();
        $finder->in($this->basePath.'/'.$eventType)
            ->sortByName()
            ->files();

        return $finder;
    }
}
