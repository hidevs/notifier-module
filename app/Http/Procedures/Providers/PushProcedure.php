<?php

namespace Modules\Notifier\Http\Procedures\Providers;

use Modules\Notifier\Contracts\BaseProcedure;
use Modules\Notifier\Http\Requests\Procedures\Push\PushSendAllRequest;
use Modules\Notifier\Http\Resources\Notification\NotificationIndexResource;
use Sajya\Server\Attributes\RpcMethod;

class PushProcedure extends BaseProcedure
{
    public static string $name = 'push';

    #[RpcMethod(
        description: 'Send a push notification to a device',
        params: [
            'provider' => 'enum:fcm',
            'token' => 'string',
            'title' => 'string',
            'body' => 'string',
            'icon' => 'string',
            'data' => 'object',
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
    public function send(PushSendAllRequest $request): NotificationIndexResource
    {
        $notification = $this->notification($request->body);
        $request->provider()->run('send', $notification, ...$request->safe(['token', 'title', 'body', 'icon', 'data']));

        return new NotificationIndexResource($notification);
    }

    #[RpcMethod(
        description: 'Send a push notification to more than a few devices',
        params: [
            'provider' => 'enum:fcm',
            'tokens' => 'array',
            'title' => 'string',
            'body' => 'string',
            'icon' => 'string',
            'data' => 'object',
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
    public function sendMulticast(PushSendAllRequest $request): NotificationIndexResource
    {
        $notification = $this->notification($request->body);
        $request->provider()->run('sendMulticast', $notification, ...$request->safe(['tokens', 'title', 'body', 'icon', 'data']));

        return new NotificationIndexResource($notification);
    }
}
