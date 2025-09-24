<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\Field;

use Kosmosafive\Bitrix\Filter\ValueObject\FormData;

class Uuid extends Base
{
    public function setFormValue(FormData $formData): void
    {
        $formValue = $formData->offsetGet($this->fieldConfig->getId());
        if (!$formValue) {
            return;
        }

        $this->value = $this->filterUuid($formValue);
    }

    public function getValue(): ?string
    {
        return $this->value?->toString();
    }
}
