<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\Handler;

abstract class Base implements HandlerInterface
{
    public function getType(): string
    {
        return static::TYPE;
    }
}
