<?php

namespace Modules\Notifier\Http\Procedures\Providers;

use Modules\Notifier\Contracts\BaseProcedure;
use Modules\Notifier\Http\Requests\Procedures\Storage\StorageSaveRequest;
use Modules\Notifier\Http\Resources\Notification\NotificationIndexResource;
use Sajya\Server\Attributes\RpcMethod;

class StorageProcedure extends BaseProcedure
{
    public static string $name = 'storage';

    #[RpcMethod(
        description: 'Save a structural message',
        params: [
            'provider' => 'enum:database',
            'sender' => 'null|string',
            'receiver' => 'string',
            'group' => 'string',
            'title' => 'string',
            'message' => 'null|string',
            'link' => 'null|string',
            'type' => 'enum:POSITIVE,ABSTAINED,NEGATIVE',
            'metadata' => 'array',
        ],
        result: [
            'id' => 'uuid',
            'user_id' => 'string',
            'provider' => 'string',
            'message' => 'string',
            'status' => 'string',
            'read_at' => 'timestamp',
            'created_at' => 'timestamp',
        ]
    )]
    public function save(StorageSaveRequest $request): NotificationIndexResource
    {
        $notification = $this->notification(@$request->message ?? $request->title);
        $request->provider()->run('save', $notification, ...$request->safe(['sender', 'receiver', 'group', 'title', 'message', 'link', 'type', 'metadata']));

        return new NotificationIndexResource($notification);
    }
}
