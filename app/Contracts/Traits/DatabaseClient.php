<?php

namespace Modules\Notifier\Contracts\Traits;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

trait DatabaseClient
{
    public function database(array $config): Builder
    {
        return DB::build($config['connection'])->table($config['table']);
    }
}
