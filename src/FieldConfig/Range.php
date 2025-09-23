<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\FieldConfig;

class Range extends Base
{
    public function __construct(
        Property\Single $property,
        string $id
    ) {
        parent::__construct($property, $id);
    }
}
