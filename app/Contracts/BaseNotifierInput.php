<?php

namespace Modules\Notifier\Contracts;

use Modules\General\Contracts\Service\BaseInput;

abstract class BaseNotifierInput extends BaseInput
{
    abstract public function params(): array;
}
