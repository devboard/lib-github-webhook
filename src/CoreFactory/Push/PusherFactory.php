<?php

declare(strict_types=1);

namespace DevboardLib\GitHubWebhook\CoreFactory\Push;

use DevboardLib\Generix\EmailAddress;
use DevboardLib\GitHub\User\UserLogin;
use DevboardLib\GitHubWebhook\Core\Push\Pusher;

class PusherFactory
{
    public function create(array $data): Pusher
    {
        return new Pusher(new UserLogin($data['name']), new EmailAddress($data['email']));
    }
}
