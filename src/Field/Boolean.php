<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\Field;

use Kosmosafive\Bitrix\Filter\FieldConfig;
use Kosmosafive\Bitrix\Filter\ValueObject;

class Boolean extends Base
{
    public function __construct(
        FieldConfig\Simple $fieldConfig,
    ) {
        parent::__construct($fieldConfig);
    }

    public function setFormValue(ValueObject\FormData $formData): void
    {
        $value = $formData->offsetGet($this->fieldConfig->getId());
        if (!$value) {
            return;
        }

        $this->value = $this->filterBoolean($value);
    }
}
