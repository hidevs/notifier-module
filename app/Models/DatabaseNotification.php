<?php

namespace Modules\Notifier\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\General\Contracts\Trait\WithUuidColumn;
use Modules\Notifier\Enums\EnumStorageNotificationType;

class DatabaseNotification extends Model
{
    use WithUuidColumn;

    protected $table = 'database_notifications';

    protected $guarded = [];

    protected $casts = [
        'type' => EnumStorageNotificationType::class,
        'metadata' => 'array',
        'read_at' => 'datetime',
    ];
}
