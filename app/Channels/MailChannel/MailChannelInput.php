<?php

namespace Modules\Notifier\Channels\MailChannel;

use Modules\Notifier\Contracts\BaseNotifierInput;
use Spatie\LaravelData\Attributes\Validation\Exists;

class MailChannelInput extends BaseNotifierInput
{
    public function __construct(
        #[Exists('providers', 'slug')]
        public readonly string $provider,
        public readonly ?string $toName,
        public readonly string $toAddress,
        public readonly string $subject,
        public readonly string $html
    ) {}

    public function params(): array
    {
        return [
            ['name' => $this->toName, 'address' => $this->toAddress], $this->subject, $this->html,
        ];
    }
}
