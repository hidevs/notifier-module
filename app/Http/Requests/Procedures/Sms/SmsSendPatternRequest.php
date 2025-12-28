<?php

namespace Modules\Notifier\Http\Requests\Procedures\Sms;

use Modules\General\Enums\EnumRegion;
use Modules\Notifier\Contracts\Traits\WithProviderRequest;
use Propaganistas\LaravelPhone\Rules\Phone;

class SmsSendPatternRequest extends WithProviderRequest
{
    public function addRules(): array
    {
        return [
            'to' => ['required', 'string', (new Phone)->international()->country(EnumRegion::current()->iso2())],
            'template' => ['required', 'string', 'max:255'],
            'tokens' => ['required', 'array', 'min:1'],
        ];
    }
}
