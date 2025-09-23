<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\FieldConfig\Property;

readonly class Multiple implements PropertyInterface
{
    public function __construct(
        protected PropertyCollection $propertyCollection,
    ) {
    }

    public function getPropertyCollection(): PropertyCollection
    {
        return $this->propertyCollection;
    }
}
