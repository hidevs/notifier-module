<?php

namespace Modules\Notifier\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Modules\Notifier\Models\Notifier;
use Modules\Notifier\Models\Provider;
use Sajya\Server\Procedure as RPCProcedure;

abstract class BaseProcedure extends RPCProcedure
{
    public static string $name;

    protected null|Builder|Model|Provider $provider = null;

    protected function currentMethod(int $debugBacktraceIndex = 1): string
    {
        return static::$name.'@'.debug_backtrace()[$debugBacktraceIndex]['function'];
    }

    protected function notification(?string $message = null, array $attributes = []): Notifier
    {
        $attributes = array_merge([
            'user_id' => request()->header('X-User-Id'),
            'systematic' => request()->header('X-Systematic'),
            'message' => $message,
            'request' => [
                'method' => $this->currentMethod(2),
                'params' => \request()->json()->all(),
            ],
        ], $attributes);

        return \request()->provider()->notifiers()->create($attributes);
    }
}
