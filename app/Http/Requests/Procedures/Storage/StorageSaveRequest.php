<?php

namespace Modules\Notifier\Http\Requests\Procedures\Storage;

use Modules\General\Rules\EnumRule;
use Modules\Notifier\Contracts\Traits\WithProviderRequest;
use Modules\Notifier\Enums\EnumStorageNotificationType;

class StorageSaveRequest extends WithProviderRequest
{
    public function addRules(): array
    {
        return [
            'sender' => ['nullable', 'string'],
            'receiver' => ['required', 'string'],
            'group' => ['nullable', 'string'],
            'title' => ['required', 'string'],
            'message' => ['nullable', 'string'],
            'link' => ['nullable', 'string', 'url'],
            'type' => ['required', 'string', new EnumRule(EnumStorageNotificationType::class)],
            'metadata' => ['required', 'array'],
        ];
    }
}
