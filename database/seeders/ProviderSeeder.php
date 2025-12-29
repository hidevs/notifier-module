<?php

namespace Modules\Notifier\Database\Seeders;

use Modules\General\Contracts\Seeder\BaseSeeder;
use Modules\Notifier\Models\Provider;

class ProviderSeeder extends BaseSeeder
{
    public function init(): void
    {
        foreach ($this->providers() as $provider) {
            Provider::query()->create($provider);
        }
    }

    public function fake(): void
    {
        //
    }

    public function providers(): array
    {
        return config('notifier.providers', []);
    }
}
