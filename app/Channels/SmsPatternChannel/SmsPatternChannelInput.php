<?php

namespace Modules\Notifier\Channels\SmsPatternChannel;

use Illuminate\Contracts\Support\Arrayable;
use Modules\Notifier\Contracts\BaseNotifierInput;
use Spatie\LaravelData\Attributes\Validation\Exists;

class SmsPatternChannelInput extends BaseNotifierInput
{
    public function __construct(
        #[Exists('providers', 'slug')]
        public readonly string $provider,
        public readonly string $template,
        public readonly string $to,
        public readonly Arrayable|array $tokens
    ) {}

    public function params(): array
    {
        return [
            $this->template, $this->to, $this->tokens instanceof Arrayable ? $this->tokens->toArray() : $this->tokens,
        ];
    }
}
