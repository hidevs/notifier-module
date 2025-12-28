<?php

namespace Modules\Notifier\Jobs\Drivers\Push\Fcm;

use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification as FcmNotification;
use Modules\Notifier\Contracts\BaseDriver;
use Modules\Notifier\Contracts\Traits\FcmClient;
use Modules\Notifier\Enums\EnumNotificationStatus;
use Modules\Notifier\Models\Notification;
use Modules\Notifier\Models\Provider;

/** Documentation: https://firebase-php.readthedocs.io/en/7.18.0/cloud-messaging.html#getting-started */
class FcmSendMulticastDriver extends BaseDriver
{
    use FcmClient;

    public function __construct(
        protected Provider $provider,
        protected Notification $notification,
        private readonly array $tokens,
        private readonly string $title,
        private readonly string $body,
        private readonly ?string $icon = null,
        private readonly array $data = [],
    ) {
        parent::__construct($provider, $notification);
    }

    public function handle(): void
    {
        try {
            $message = CloudMessage::fromArray([
                'notification' => FcmNotification::create($this->title, $this->body, $this->icon),
                'data' => $this->data,
            ]);
            $this->fcm($this->provider->config('auth'))->sendMulticast($message, $this->tokens);

            $this->updateNotification(EnumNotificationStatus::SUCCESS);
        } catch (\Throwable $e) {
            $this->updateNotification(
                EnumNotificationStatus::FAILED, ['exception' => [
                    'message' => method_exists($e, 'errorMessage') ? $e->errorMessage() : $e->getMessage(),
                    'trace' => array_map(fn ($item) => array_intersect_key($item, array_flip([
                        'file', 'line', 'function', 'class',
                    ])), $e->getTrace()),
                ]]);
            $this->fail($e);
        }
    }
}
