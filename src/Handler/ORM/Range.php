<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\Handler\ORM;

use Kosmosafive\Bitrix\Filter\Field\FieldInterface;
use Kosmosafive\Bitrix\Filter\QueryBuilder;
use Kosmosafive\Bitrix\Filter\ValueObject\FormData;

class Range extends Base
{
    /**
     * @param QueryBuilder\ORM $queryBuilder
     * @param FieldInterface   $field
     * @param FormData         $formData
     *
     * @return void
     */
    public function apply(
        QueryBuilder\QueryBuilderInterface $queryBuilder,
        FieldInterface $field,
        FormData $formData
    ): void {
        $field->setFormValue($formData);
        $rangeValue = $field->getValue();

        if ($rangeValue->getFrom() && $rangeValue->getTo()) {
            if ($rangeValue->getFrom() === $rangeValue->getTo()) {
                $queryBuilder->getQuery()->where(
                    $field->getFieldConfig()->getProperty()->getName(),
                    $rangeValue->getFrom()
                );
            } else {
                $queryBuilder->getQuery()->whereBetween(
                    $field->getFieldConfig()->getProperty()->getName(),
                    $rangeValue->getFrom(),
                    $rangeValue->getTo()
                );
            }

            return;
        }

        if ($rangeValue->getFrom()) {
            $queryBuilder->getQuery()->where(
                $field->getFieldConfig()->getProperty()->getName(),
                '>=',
                $rangeValue->getFrom()
            );
            return;
        }

        if ($rangeValue->getTo()) {
            $queryBuilder->getQuery()->where(
                $field->getFieldConfig()->getProperty()->getName(),
                '<=',
                $rangeValue->getTo()
            );
            return;
        }
    }
}
