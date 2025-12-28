<?php

namespace Modules\Notifier\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Notifier\Enums\EnumStorageNotificationType;

class DatabaseNotificationFactory extends Factory
{
    protected $model = \Modules\Notifier\Models\DatabaseNotification::class;

    public function definition(): array
    {
        return [
            'sender' => $this->faker->uuid,
            'receiver' => $this->faker->uuid,
            'group' => 'default',
            'title' => $this->faker->jobTitle,
            'message' => $this->faker->realText,
            'link' => $this->faker->url,
            'type' => $this->faker->randomElement(EnumStorageNotificationType::cases()),
            'metadata' => $this->faker->hslColorAsArray,
            'read_at' => $this->faker->boolean ? now() : null,
        ];
    }
}
