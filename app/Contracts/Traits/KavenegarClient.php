<?php

namespace Modules\Notifier\Contracts\Traits;

use Kavenegar\KavenegarApi;

trait KavenegarClient
{
    public function kavenegar(string $apiKey): KavenegarApi
    {
        return new KavenegarApi($apiKey);
    }
}
