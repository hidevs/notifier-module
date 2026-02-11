<?php

namespace Modules\Notifier\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Arr;

class Provider extends Model
{
    protected $guarded = ['type', 'queue'];

    protected $fillable = ['uuid', 'title', 'slug', 'config', 'drivers'];

    protected $casts = [
        'config' => 'array',
        'drivers' => 'array',
    ];

    public function run(string $method, Notifier $notifier, ...$params): mixed
    {
        return Arr::get($this->drivers, $method)::dispatch($this, $notifier, ...$params);
    }

    public function notifiers(): HasMany
    {
        return $this->hasMany(Notifier::class, 'provider_slug', 'slug');
    }

    public function config(?string $key = null): mixed
    {
        if (is_null($key)) {
            return $this->config;
        }
        $value = Arr::get($this->config, $key);
        if (is_iterable($value)) {
            return (array) $value;
        }

        return $value;
    }
}
