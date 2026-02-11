<?php

namespace Modules\Notifier\Contracts;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Notifier\Enums\EnumNotificationStatus;
use Modules\Notifier\Models\Notifier;
use Modules\Notifier\Models\Provider;

abstract class BaseDriver implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(protected Provider $provider, protected Notifier $notifier)
    {
        $this->onQueue($this->provider->queue);
    }

    protected function updateNotifier(EnumNotificationStatus $status, array $columns = []): void
    {
        $this->notifier->update(array_merge($columns, ['status' => $status]));
    }
}
