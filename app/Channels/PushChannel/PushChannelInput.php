<?php

namespace Modules\Notifier\Channels\PushChannel;

use Modules\Notifier\Contracts\BaseNotifierInput;
use Spatie\LaravelData\Attributes\Validation\Exists;

class PushChannelInput extends BaseNotifierInput
{
    public function __construct(
        #[Exists('providers', 'slug')]
        public readonly string $provider,
        public readonly array $tokens,
        public readonly string $title,
        public readonly string $body,
        public readonly ?string $icon = null,
        public readonly array $data = [],
    ) {}

    public function params(): array
    {
        return [
            $this->tokens, $this->title, $this->body, $this->icon, $this->data,
        ];
    }
}
