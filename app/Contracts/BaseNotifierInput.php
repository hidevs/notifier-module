<?php

namespace Modules\Notifier\Contracts;

use Modules\General\Contracts\DTO\BaseInput;

abstract class BaseNotifierInput extends BaseInput
{
    abstract public function params(): array;
}
