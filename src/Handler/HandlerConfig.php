<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\Handler;

final readonly class HandlerConfig
{
    public function __construct(
        private HandlerInterface $handler,
        private string $fieldClass
    ) {
    }

    public function getHandler(): HandlerInterface
    {
        return $this->handler;
    }

    public function getFieldClass(): string
    {
        return $this->fieldClass;
    }
}
