<?php

namespace Modules\Notifier\Jobs\Drivers\Sms\SmsIr;

use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Modules\Notifier\Contracts\BaseDriver;
use Modules\Notifier\Contracts\Traits\SmsIrClient;
use Modules\Notifier\Enums\EnumNotificationStatus;
use Modules\Notifier\Models\Notifier;
use Modules\Notifier\Models\Provider;

class SmsIrSendDriver extends BaseDriver
{
    use SmsIrClient;

    public function __construct(
        protected Provider $provider,
        protected Notifier $notifier,
        private readonly array $to,
        private readonly string $message,
    ) {
        parent::__construct($provider, $notifier);
    }

    public function handle(): void
    {
        try {
            $this->smsir($this->provider->config('api_key'), $this->provider->config('base_url'))
                ->likeToLikeSend($this->provider->config('line_number'), array_fill(0, count($this->to), $this->message), $this->to);

            $this->updateNotifier(EnumNotificationStatus::SUCCESS);
        } catch (ApiException|HttpException|\Exception $e) {
            $this->updateNotifier(
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
