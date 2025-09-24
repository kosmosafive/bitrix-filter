<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\ValueObject;

use InvalidArgumentException;
use Kosmosafive\Bitrix\DS\Collection;

/**
 * @template-extends Collection<Option>
 */
class OptionCollection extends Collection
{
    public function __construct(Option ...$options)
    {
        parent::__construct($options);
    }

    /**
     * @param Option $value
     *
     * @return $this
     */
    public function add(mixed $value): OptionCollection
    {
        if (!$value instanceof Option) {
            throw new InvalidArgumentException("This collection only accepts instances of " . Option::class);
        }

        return parent::add($value);
    }

    public function toArray(): array
    {
        return array_map(static fn (Option $option) => $option->toArray(), $this->values);
    }
}
