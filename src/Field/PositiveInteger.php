<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\Field;

use Kosmosafive\Bitrix\Filter\FieldConfig\FieldConfigInterface;

abstract class PositiveInteger extends Integer
{
    public function __construct(
        FieldConfigInterface $fieldConfig
    ) {
        parent::__construct($fieldConfig, 1);
    }
}
