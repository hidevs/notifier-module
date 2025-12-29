<?php

namespace Modules\Notifier\Enums;

use Modules\General\Contracts\Enum\EnumMethods;

enum EnumNotificationStatus: string
{
    use EnumMethods;

    case FAILED = 'FAILED';

    case PROCESS = 'PROCESS';

    case SUCCESS = 'SUCCESS';
}
