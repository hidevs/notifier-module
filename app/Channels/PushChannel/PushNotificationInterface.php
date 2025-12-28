<?php

namespace Modules\Notifier\Channels\PushChannel;

interface PushNotificationInterface
{
    public function toPush($notifiable): PushChannelInput;
}
