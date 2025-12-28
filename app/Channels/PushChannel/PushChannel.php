<?php

namespace Modules\Notifier\Channels\PushChannel;

use Illuminate\Notifications\Notification;
use Modules\Notifier\Contracts\BaseNotifierChannel;

class PushChannel extends BaseNotifierChannel
{
    public function send($notifiable, Notification $notification)
    {
        $arguments = $notification->toPush($notifiable);

        return $this->dispatch(
            $arguments, $this->notification($arguments, $arguments->title)
        );
    }

    public function method(): string
    {
        return 'sendMulticast';
    }
}
