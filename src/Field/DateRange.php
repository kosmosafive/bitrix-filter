<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\Field;

use Bitrix\Main\Type;
use Kosmosafive\Bitrix\Filter\FieldConfig;
use Kosmosafive\Bitrix\Filter\ValueObject;

class DateRange extends Base
{
    public function __construct(
        FieldConfig\Simple $fieldConfig,
        protected readonly ?Type\Datetime $minDate = null,
        protected readonly ?Type\Datetime $maxDate = null,
        protected readonly bool $dateOnly = true,
        protected readonly string $dateFormat = DATE_ATOM
    ) {
        parent::__construct($fieldConfig);

        $this->value = new ValueObject\Range();
    }

    public function setFormValue(ValueObject\FormData $formData): void
    {
        $formValue = [];

        foreach (['from', 'to'] as $key) {
            $value = $formData->offsetGet($this->fieldConfig->getId() . '_' . $key);
            if (!$value) {
                $formValue[$key] = null;
                continue;
            }

            $filteredValue = Type\DateTime::tryParse($value, $this->dateFormat);
            if ($filteredValue) {
                if ($key === 'from') {
                    $filteredValue->setTime(0, 0);
                } else {
                    $filteredValue
                        ->add('1 day')
                        ->setTime(0, 0);
                }

                if (
                    (
                        $this->minDate
                        && ($filteredValue->getTimestamp() < $this->minDate->getTimestamp())
                    )
                    || (
                        $this->maxDate
                        && ($filteredValue->getTimestamp() > $this->maxDate->getTimestamp())
                    )
                ) {
                    $filteredValue = null;
                }
            }

            $formValue[$key] = $filteredValue;
        }

        $this->value = new ValueObject\Range(...$formValue);
    }

    public function getMinDate(): ?Type\Datetime
    {
        return $this->minDate;
    }

    public function getMaxDate(): ?Type\Datetime
    {
        return $this->maxDate;
    }

    public function isDateOnly(): bool
    {
        return $this->dateOnly;
    }
}
