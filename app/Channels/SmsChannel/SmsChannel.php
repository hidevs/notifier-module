<?php

namespace Modules\Notifier\Channels\SmsChannel;

use Illuminate\Notifications\Notification;
use Modules\Notifier\Contracts\BaseNotifierChannel;

class SmsChannel extends BaseNotifierChannel
{
    public function send($notifiable, Notification $notification)
    {
        $arguments = $notification->toSms($notifiable);

        return $this->dispatch(
            $arguments, $this->notification($arguments, $arguments->message)
        );
    }

    public function method(): string
    {
        return 'send';
    }
}
