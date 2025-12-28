<?php

namespace Modules\Notifier\Http\Requests\Procedures\Push;

use Modules\Notifier\Contracts\Traits\WithProviderRequest;

class PushSendAllRequest extends WithProviderRequest
{
    public function addRules(): array
    {
        return [
            'tokens' => ['required', 'array'],
            'tokens.*' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string'],
            'data' => ['nullable', 'array'],
        ];
    }
}
