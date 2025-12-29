<?php

namespace Modules\Notifier\Repositories;

use Modules\General\Contracts\Repository\BaseApiRepository;
use Modules\Notifier\Models\DatabaseNotification;

class DatabaseNotificationRepository extends BaseApiRepository
{
    protected $fieldSearchable = [
        'sender' => '=',
        'group' => '=',
        'created_at' => '>=',
    ];

    protected array $fieldFilterable = [
        'read',
        'sender',
        'group',
        'created_at',
    ];

    public function model(): string
    {
        return DatabaseNotification::class;
    }

    protected function filterRead(string $term): void
    {
        if (filter_var($term, FILTER_VALIDATE_BOOLEAN)) {
            $this->model = $this->model->whereNotNull('read_at');
        } else {
            $this->model = $this->model->whereNull('read_at');
        }
    }

    protected function filterSender(string $sender): void
    {
        $this->model = $this->model->where('sender', $sender);
    }

    protected function filterGroup(string $group): void
    {
        $this->model = $this->model->where('group', $group);
    }

    protected function filterCreatedAt(string $createdAt): void
    {
        $this->model = $this->model->where('created_at', '>=', $createdAt);
    }
}
