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
        if (null !== $data['email']) {
            $emailAddress = new EmailAddress($data['email']);
        } else {
            $emailAddress = null;
        }

        return new Pusher(new UserLogin($data['name']), $emailAddress);
    }
}
