<?php

namespace Modules\Notifier\Channels\StorageChannel;

use Modules\Notifier\Contracts\BaseNotifierInput;
use Modules\Notifier\Enums\EnumStorageNotificationType;
use Spatie\LaravelData\Attributes\Validation\Exists;

class StorageChannelInput extends BaseNotifierInput
{
    public function __construct(
        #[Exists('providers', 'slug')]
        public readonly string $provider,
        public readonly string $receiver,
        public readonly string $group,
        public readonly string $title,
        public readonly string|EnumStorageNotificationType $type,
        public readonly ?string $message = null,
        public readonly ?string $sender = null,
        public readonly ?string $link = null,
        public readonly array $metadata = [],
    ) {}

    public function params(): array
    {
        return [
            'receiver' => $this->receiver,
            'group' => $this->group,
            'title' => $this->title,
            'type' => $this->type,
            'message' => $this->message,
            'sender' => $this->sender,
            'link' => $this->link,
            'metadata' => $this->metadata,
        ];
    }
}
