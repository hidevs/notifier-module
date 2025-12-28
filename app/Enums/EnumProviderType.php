<?php

namespace Modules\Notifier\Enums;

use Modules\General\Contracts\EnumMethods;
use Rawilk\Settings\Facades\Settings;

enum EnumProviderType: string
{
    use EnumMethods;

    case MAIL = 'MAIL';

    case SMS = 'SMS';

    case STORAGE = 'STORAGE';

    case PUSH = 'PUSH';

    public function default(bool $throwIfNull = true): string
    {
        $default = Settings::get($this->defaultSettingKey());

        throw_if(
            is_null($default) && $throwIfNull,
            new \Exception("Default provider is not set for {$this->value} type.")
        );

        return $default;
    }

    public function defaultSettingKey(): string
    {
        $driver = strtolower($this->value);
        return "notifier.provider.{$driver}.default";
    }
}
