<?php

namespace Modules\Notifier\Channels\SmsChannel;

use Modules\Notifier\Contracts\BaseNotifierInput;
use Spatie\LaravelData\Attributes\Validation\Exists;

class SmsChannelInput extends BaseNotifierInput
{
    public function __construct(
        #[Exists('providers', 'slug')]
        public readonly string $provider,
        public readonly array $to,
        public readonly string $message,
    ) {}

    public function params(): array
    {
        return [
            $this->to, $this->message,
        ];
    }
}
