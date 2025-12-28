<?php

namespace Modules\Notifier\Enums;

use Modules\General\Contracts\EnumMethods;

enum EnumNotificationStatus: string
{
    use EnumMethods;

    case FAILED = 'FAILED';

    case PROCESS = 'PROCESS';

    case SUCCESS = 'SUCCESS';
}
