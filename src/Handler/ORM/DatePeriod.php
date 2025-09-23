<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\Handler\ORM;

use Kosmosafive\Bitrix\Filter\Field\FieldInterface;
use Kosmosafive\Bitrix\Filter\FieldConfig\Property;
use Kosmosafive\Bitrix\Filter\QueryBuilder;
use Kosmosafive\Bitrix\Filter\ValueObject\FormData;

class DatePeriod extends Base
{
    public function apply(
        QueryBuilder\QueryBuilderInterface $queryBuilder,
        FieldInterface $field,
        FormData $formData
    ): void {
        $field->setFormValue($formData);
        $formValue = $field->getValue();
        if ($formValue->isEmpty()) {
            return;
        }

        /**
         * @var Property\DatePeriod $property
         */
        $property = $field->getFieldConfig()->getProperty();

        $queryBuilder->getQuery()->where($property->getYear(), $formValue->getYear());

        if ($formValue->getQuarter()) {
            $queryBuilder->getQuery()->where($property->getQuarter(), $formValue->getQuarter());
        } elseif ($formValue->getMonth()) {
            $queryBuilder->getQuery()->where($property->getMonth(), $formValue->getMonth());
        }
    }
}
