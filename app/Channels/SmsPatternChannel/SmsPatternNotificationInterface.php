<?php

namespace Modules\Notifier\Channels\SmsPatternChannel;

interface SmsPatternNotificationInterface
{
    public function toSmsPattern($notifiable): SmsPatternChannelInput;
}
