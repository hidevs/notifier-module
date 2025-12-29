<?php

namespace Modules\Notifier\Database\Seeders;

use Modules\General\Contracts\Seeder\BaseSeeder;

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
