<?php

use Illuminate\Http\Request;
use Modules\Notifier\Models\Provider;

Request::macro('provider', function (string $dbColumn = 'slug', string $requestKey = 'provider') {
    if (is_null(\request()->get($requestKey))) {
        return;
    }

    return Provider::query()->where($dbColumn, \request()->get($requestKey))->firstOrFail();
});
