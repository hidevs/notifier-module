<?php

namespace Modules\Notifier\Http\Procedures\Providers;

use Modules\Notifier\Contracts\BaseProcedure;
use Modules\Notifier\Http\Requests\Procedures\Mail\MailSendRequest;
use Modules\Notifier\Http\Resources\Notification\NotificationIndexResource;
use Sajya\Server\Attributes\RpcMethod;

class MailProcedure extends BaseProcedure
{
    public static string $name = 'mail';

    #[RpcMethod(
        description: 'Send html mail message',
        params: [
            'provider' => 'enum:smtp',
            'subject' => 'string',
            'html' => 'html',
            'to' => [
                'name' => 'string',
                'address' => 'email',
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
    public function send(MailSendRequest $request): NotificationIndexResource
    {
        $notification = $this->notification($request->html);
        $request->provider()->run('send', $notification, ...$request->safe(['to', 'subject', 'html']));

        return new NotificationIndexResource($notification);
    }
}
