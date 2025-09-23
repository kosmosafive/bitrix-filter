<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\FieldConfig;

class Simple extends Base
{
    public function __construct(
        Property\Single|Property\Multiple $property,
        string $id
    ) {
        parent::__construct($property, $id);
    }
}
