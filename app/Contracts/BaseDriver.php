<?php

namespace Modules\Notifier\Contracts;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Notifier\Enums\EnumNotificationStatus;
use Modules\Notifier\Models\Notification;
use Modules\Notifier\Models\Provider;

abstract class BaseDriver implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected Provider $provider, protected Notification $notification)
    {
        $this->onQueue($this->provider->queue);
    }

    protected function updateNotification(EnumNotificationStatus $status, array $columns = []): void
    {
        $this->notification->update(array_merge($columns, [
            'status' => $status,
        ]));
    }
}
