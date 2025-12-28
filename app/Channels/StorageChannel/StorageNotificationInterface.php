<?php

namespace Modules\Notifier\Channels\StorageChannel;

interface StorageNotificationInterface
{
    public function toStorage($notifiable): StorageChannelInput;
}
