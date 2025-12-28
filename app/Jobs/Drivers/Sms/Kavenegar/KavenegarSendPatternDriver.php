<?php

namespace Modules\Notifier\Jobs\Drivers\Sms\Kavenegar;

use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Modules\Notifier\Contracts\BaseDriver;
use Modules\Notifier\Contracts\Traits\KavenegarClient;
use Modules\Notifier\Enums\EnumNotificationStatus;
use Modules\Notifier\Models\Notification;
use Modules\Notifier\Models\Provider;

class KavenegarSendPatternDriver extends BaseDriver
{
    use KavenegarClient;

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
            $additionalTokens = array_filter([@$this->tokens[3], @$this->tokens[4]]);
            $this->kavenegar($this->provider->config('api_key'))
                ->VerifyLookup($this->to, @$this->tokens[0], @$this->tokens[1], @$this->tokens[2], $this->template, null, ...$additionalTokens);

            $this->updateNotification(EnumNotificationStatus::SUCCESS);
        } catch (ApiException|HttpException|\Exception $e) {
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
