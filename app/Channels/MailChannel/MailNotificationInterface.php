<?php

namespace Modules\Notifier\Channels\MailChannel;

interface MailNotificationInterface
{
    public function toMail($notifiable): MailChannelInput;
}
