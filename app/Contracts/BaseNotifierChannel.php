<?php

namespace Modules\Notifier\Contracts;

use Illuminate\Notifications\Notification as BaseNotification;
use Modules\Notifier\Models\Notifier;
use Modules\Notifier\Models\Provider;

abstract class BaseNotifierChannel
{
    abstract public function send($notifiable, BaseNotification $notification);

    abstract public function method(): string;

    protected function dispatch(BaseNotifierInput $input, Notifier $notifier)
    {
        return $this->provider($input->provider)->run($this->method(), $notifier, ...$input->params());
    }

    protected function provider(string $slug): Provider
    {
        return Provider::query()->where('slug', $slug)->firstOrFail();
    }

    protected function notification(BaseNotifierInput $input, ?string $message = null, array $attributes = []): Notifier
    {
        $attributes = array_merge([
            'systematic' => true,
            'message' => $message,
            'request' => [
                'method' => $this->method(),
                'params' => [
                    'provider' => $input->provider,
                    ...$input->toArray(),
                ],
                //                'trace' => debug_backtrace()
            ],
        ], $attributes);

        return $this->provider($input->provider)->notifiers()->create($attributes);
    }
}
