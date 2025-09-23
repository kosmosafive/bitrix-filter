<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\Handler;

use Kosmosafive\Bitrix\DS\Collection;

/**
 * @template-extends Collection<HandlerConfig>
 */
class HandlerCollection extends Collection
{
    /**
     * @param HandlerConfig $value
     *
     * @return $this
     */
    public function add(mixed $value): HandlerCollection
    {
        $handler = $value->getHandler();
        $this->values[$handler->getType()][$value->getFieldClass()] = $handler;

        return $this;
    }

    public function get(string $type, string $fieldClass): ?HandlerInterface
    {
        return $this->values[$type][$fieldClass] ?? null;
    }
}
