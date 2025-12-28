<?php

namespace Modules\Notifier\Contracts\Traits;

use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Factory;

trait FcmClient
{
    public function fcm(array|string $auth): Messaging
    {
        return (new Factory)->withServiceAccount($auth)->createMessaging();
    }
}
