<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\Handler\ORM;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\ORM\Query\Query;
use Kosmosafive\Bitrix\Filter\Field\FieldInterface;
use Kosmosafive\Bitrix\Filter\FieldConfig\Property;
use Kosmosafive\Bitrix\Filter\QueryBuilder;
use Kosmosafive\Bitrix\Filter\ValueObject\FormData;

class Contains extends Base
{
    /**
     * @param QueryBuilder\ORM $queryBuilder
     * @param FieldInterface   $field
     * @param FormData         $formData
     *
     * @return void
     *
     * @throws ArgumentException
     */
    public function apply(
        QueryBuilder\QueryBuilderInterface $queryBuilder,
        FieldInterface $field,
        FormData $formData
    ): void {
        $field->setFormValue($formData);
        $formValue = $field->getValue();
        if (!$formValue) {
            return;
        }

        $property = $field->getFieldConfig()->getProperty();

        if ($property instanceof Property\Multiple) {
            $queryFilter = Query::filter()->logic('or');

            foreach ($property->getPropertyCollection() as $singleProperty) {
                $propertyName = $singleProperty->getName();
                foreach ((array) $formValue as $singleValue) {
                    $queryFilter->whereLike($propertyName, $singleValue);
                }
            }

            $queryBuilder->getQuery()->where($queryFilter);
        } elseif ($property instanceof Property\Single) {
            $propertyName = $property->getName();

            if (is_array($formValue)) {
                $queryFilter = Query::filter()->logic('or');

                foreach ($formValue as $singleValue) {
                    $queryFilter->whereLike($propertyName, $singleValue);
                }

                $queryBuilder->getQuery()->where($queryFilter);
            } else {
                $queryBuilder->getQuery()->whereLike($propertyName, $formValue);
            }
        }
    }
}
