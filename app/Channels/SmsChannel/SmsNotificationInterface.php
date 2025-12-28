<?php

namespace Modules\Notifier\Channels\SmsChannel;

interface SmsNotificationInterface
{
    public function toSms($notifiable): SmsChannelInput;
}
