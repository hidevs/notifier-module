<?php

namespace Modules\Notifier\Http\Requests\Procedures\Mail;

use Modules\Notifier\Contracts\Traits\WithProviderRequest;

class MailSendRequest extends WithProviderRequest
{
    public function addRules(): array
    {
        return [
            'to' => ['required', 'array'],
            'to.address' => ['required', 'email'],
            'to.name' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'html' => ['required', 'string'],
        ];
    }
}
