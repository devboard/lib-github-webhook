<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\Label;

use DevboardLib\GitHub\GitHubLabel;
use DevboardLib\GitHub\Label\LabelColor;
use DevboardLib\GitHub\Label\LabelId;
use DevboardLib\GitHub\Label\LabelName;

/**
 * @see GitHubLabelFactorySpec
 * @see GitHubLabelFactoryTest
 */
class GitHubLabelFactory
{
    public function create(array $data): GitHubLabel
    {
        return new GitHubLabel(
            new LabelId($data['id']),
            new LabelName($data['name']),
            new LabelColor($data['color']),
            $data['default']
        );
    }
}
