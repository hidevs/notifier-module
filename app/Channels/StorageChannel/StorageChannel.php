<?php

namespace Modules\Notifier\Channels\StorageChannel;

use Illuminate\Notifications\Notification;
use Modules\Notifier\Contracts\BaseNotifierChannel;

class StorageChannel extends BaseNotifierChannel
{
    public function send($notifiable, Notification $notification)
    {
        $arguments = $notification->toStorage($notifiable);

        return $this->dispatch(
            $arguments, $this->notification($arguments, $arguments->message)
        );
    }

    public function method(): string
    {
        return 'save';
    }
}
