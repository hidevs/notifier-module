<?php

namespace Modules\Notifier\Http\Requests\Procedures\Sms;

use Modules\General\Enums\EnumRegion;
use Modules\Notifier\Contracts\Traits\WithProviderRequest;
use Propaganistas\LaravelPhone\Rules\Phone;

class SmsSendRequest extends WithProviderRequest
{
    public function addRules(): array
    {
        return [
            'to' => ['required', 'array', 'min:1'],
            'to.*' => ['required', 'string', (new Phone)->international()->country(EnumRegion::current()->iso2())],
            'message' => ['required', 'string', 'max:255'],
        ];
    }
}
