<?php

namespace Modules\Notifier\Enums;

use Modules\General\Contracts\EnumMethods;

enum EnumStorageNotificationType: string
{
    use EnumMethods;

    case POSITIVE = 'POSITIVE';

    case ABSTAINED = 'ABSTAINED';

    case NEGATIVE = 'NEGATIVE';
}
