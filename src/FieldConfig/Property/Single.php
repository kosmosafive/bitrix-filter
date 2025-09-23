<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\FieldConfig\Property;

readonly class Single implements PropertyInterface
{
    public function __construct(
        protected string $name
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }
}
