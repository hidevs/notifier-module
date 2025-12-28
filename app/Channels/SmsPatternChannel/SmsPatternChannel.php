<?php

namespace Modules\Notifier\Channels\SmsPatternChannel;

use Illuminate\Notifications\Notification;
use Modules\Notifier\Contracts\BaseNotifierChannel;

class SmsPatternChannel extends BaseNotifierChannel
{
    public function send($notifiable, Notification $notification)
    {
        $arguments = $notification->toSmsPattern($notifiable);

        return $this->dispatch(
            $arguments, $this->notification($arguments, "Template: {$arguments->template} | Tokens: ".json_encode($arguments->tokens))
        );
    }

    public function method(): string
    {
        return 'sendPattern';
    }
}
