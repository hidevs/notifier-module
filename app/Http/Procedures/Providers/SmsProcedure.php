<?php

namespace Modules\Notifier\Http\Procedures\Providers;

use Modules\Notifier\Contracts\BaseProcedure;
use Modules\Notifier\Http\Requests\Procedures\Sms\SmsSendPatternRequest;
use Modules\Notifier\Http\Requests\Procedures\Sms\SmsSendRequest;
use Modules\Notifier\Http\Resources\Notification\NotificationIndexResource;
use Sajya\Server\Attributes\RpcMethod;

class SmsProcedure extends BaseProcedure
{
    public static string $name = 'sms';

    #[RpcMethod(
        description: 'Send normal sms message',
        params: [
            'provider' => 'enum:kavenegar,smsir',
            'message' => 'string',
            'to' => [
                'phone',
            ],
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
    public function send(SmsSendRequest $request): NotificationIndexResource
    {
        $notification = $this->notification($request->message);
        $request->provider()->run('send', $notification, ...$request->safe(['to', 'message']));

        return new NotificationIndexResource($notification);
    }

    #[RpcMethod(
        description: 'Send pattern sms message',
        params: [
            'provider' => 'enum:kavenegar,smsir',
            'to' => 'phone',
            'template' => 'string',
            'tokens' => [
                'token1',
                [
                    'name' => 'name-of-parameter',
                    'value' => 'value-of-parameter',
                ],
                'token3',
            ],
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
    public function sendPattern(SmsSendPatternRequest $request): NotificationIndexResource
    {
        $notification = $this->notification("Template: {$request->template} | Tokens: ".json_encode($request->tokens));
        $request->provider()->run('sendPattern', $notification, ...$request->safe(['template', 'to', 'tokens']));

        return new NotificationIndexResource($notification);
    }
}
