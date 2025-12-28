<?php

namespace Modules\Notifier\Http\Resources\Notification;

use Illuminate\Http\Request;
use Modules\General\Http\Resources\EnumResource;
use Modules\Notifier\Contracts\BaseResource;

class NotificationShowResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            '_type' => class_basename($this->resource),
            'id' => $this->resource->uuid,
            'provider' => $this->resource->provider_slug,
            'user_id' => $this->resource->user_id,
            'response' => optional($this->resource->response)->toArray(),
            'message' => $this->resource->message,
            'status' => new EnumResource($this->resource->status),
            'read_at' => @$this->resource->read_at->timestamp,
            'created_at' => $this->resource->created_at->timestamp,
            'updated_at' => $this->resource->updated_at->timestamp,
        ];
    }
}
