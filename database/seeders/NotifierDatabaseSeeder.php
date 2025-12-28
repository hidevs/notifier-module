<?php

namespace Modules\Notifier\Database\Seeders;

use Modules\General\Contracts\BaseSeeder;

class NotifierDatabaseSeeder extends BaseSeeder
{
    public function init(): void
    {
        $this->call([
            ProviderSeeder::class,
        ]);
    }

    public function fake(): void
    {
        //
    }
}
