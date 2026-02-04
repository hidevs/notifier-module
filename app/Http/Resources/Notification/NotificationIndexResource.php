<?php

namespace Modules\Notifier\Http\Resources\Notification;

use Illuminate\Http\Request;
use Modules\General\Contracts\Resource\BaseResource;
use Modules\General\Http\Resources\EnumResource;

class NotificationIndexResource extends BaseResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->resource->uuid,
            'user_id' => $this->resource->user_id,
            'provider' => $this->resource->provider_slug,
            'message' => $this->resource->message,
            'status' => new EnumResource($this->resource->status),
            'read_at' => @$this->resource->read_at->timestamp,
            'created_at' => $this->resource->created_at->timestamp,
        ];
    }
}
