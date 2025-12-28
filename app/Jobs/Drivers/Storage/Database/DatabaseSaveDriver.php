<?php

namespace Modules\Notifier\Jobs\Drivers\Storage\Database;

use Kavenegar\Exceptions\ApiException;
use Kavenegar\Exceptions\HttpException;
use Modules\Notifier\Contracts\BaseDriver;
use Modules\Notifier\Contracts\Traits\DatabaseClient;
use Modules\Notifier\Enums\EnumNotificationStatus;
use Modules\Notifier\Enums\EnumStorageNotificationType;
use Modules\Notifier\Models\DatabaseNotification;
use Modules\Notifier\Models\Notification;
use Modules\Notifier\Models\Provider;

class DatabaseSaveDriver extends BaseDriver
{
    use DatabaseClient;

    public function __construct(
        protected Provider $provider,
        protected Notification $notification,
        private readonly string $receiver,
        private readonly string $group,
        private readonly string $title,
        private readonly string|EnumStorageNotificationType $type,
        private readonly ?string $message = null,
        private readonly ?string $sender = null,
        private readonly ?string $link = null,
        private readonly array $metadata = [],
    ) {
        parent::__construct($provider, $notification);
    }

    public function handle(): void
    {
        try {
            DatabaseNotification::query()->create($this->data());

            $this->updateNotification(EnumNotificationStatus::SUCCESS);
        } catch (ApiException|HttpException|\Exception $e) {
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

    public function data(): array
    {
        return [
            'sender' => $this->sender,
            'receiver' => $this->receiver,
            'group' => $this->group,
            'title' => $this->title,
            'message' => $this->message,
            'link' => $this->link,
            'type' => $this->type,
            'metadata' => $this->metadata,
        ];
    }
}
