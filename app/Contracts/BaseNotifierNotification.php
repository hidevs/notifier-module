<?php

namespace Modules\Notifier\Contracts;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Rawilk\Settings\Facades\Settings;

abstract class BaseNotifierNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function getQueue(): string
    {
        return 'notification';
    }

    public function via($notifiable): array
    {
        return array_keys(array_filter(Settings::get('notification.class.'.static::class.'.via', [])));
    }
}
