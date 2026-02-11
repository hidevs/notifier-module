<?php

namespace Modules\Notifier\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\General\Contracts\Trait\WithUuidColumn;
use Modules\Notifier\Enums\EnumNotificationStatus;

class Notifier extends Model
{
    use WithUuidColumn;

    protected $table = 'notifiers';

    protected $guarded = ['user_id', 'provider_slug', 'request'];

    protected $fillable = ['message', 'user_id', 'systematic', 'provider_slug', 'read_at', 'request', 'response', 'exception', 'status'];

    protected $casts = [
        'request' => 'collection',
        'read_at' => 'datetime',
        'response' => 'collection',
        'systematic' => 'bool',
        'exception' => 'collection',
        'status' => EnumNotificationStatus::class,
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function (self $model) {
            $model->status = @$model->attributes['status'] ?? EnumNotificationStatus::PROCESS;
            $model->systematic = @$model->attributes['systematic'] ?? false;
        });
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_slug', 'slug');
    }
}
