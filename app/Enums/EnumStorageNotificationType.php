<?php

namespace Modules\Notifier\Enums;

use Modules\General\Contracts\Enum\EnumMethods;

enum EnumStorageNotificationType: string
{
    use EnumMethods;

    case POSITIVE = 'POSITIVE';

    case ABSTAINED = 'ABSTAINED';

    case NEGATIVE = 'NEGATIVE';
}
