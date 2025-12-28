<?php

namespace Modules\Notifier\Jobs\Drivers\Sms\SmsIr;

use Modules\Notifier\Contracts\BaseDriver;
use Modules\Notifier\Contracts\Traits\SmsIrClient;
use Modules\Notifier\Enums\EnumNotificationStatus;
use Modules\Notifier\Models\Notification;
use Modules\Notifier\Models\Provider;

class SmsIrSendPatternDriver extends BaseDriver
{
    use SmsirClient;

    public function __construct(
        protected Provider $provider,
        protected Notification $notification,
        private readonly string $template,
        private readonly string $to,
        private readonly array $tokens,
    ) {
        parent::__construct($provider, $notification);
    }

    public function handle(): void
    {
        try {
            $this->smsir($this->provider->config('api_key'), $this->provider->config('base_url'))
                ->verifySend($this->to, $this->template, $this->tokens);

            $this->updateNotification(EnumNotificationStatus::SUCCESS);
        } catch (\Throwable $e) {
            $this->updateNotification(
                EnumNotificationStatus::FAILED, ['exception' => [
                    'message' => method_exists($e, 'errorMessage') ? $e->errorMessage() : $e->getMessage(),
                    'trace' => array_map(fn ($item) => array_intersect_key($item, array_flip([
                        'file', 'line', 'function', 'class',
                    ])), $e->getTrace()),
                ]]);
            $this->fail($e);
        }
    }
}
