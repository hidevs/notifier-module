<?php

namespace Modules\Notifier\Contracts\Traits;

use Ipe\Sdk\SmsIrService;

trait SmsIrClient
{
    public function smsir(string $apiKey, string $baseUrl): SmsIrService
    {
        return new SmsIrService($apiKey, $baseUrl);
    }
}
