<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\QueryBuilder;

use Kosmosafive\Bitrix\Filter\Field\FieldCollection;
use Kosmosafive\Bitrix\Filter\Handler\Factory;
use Kosmosafive\Bitrix\Filter\ValueObject\FormData;

abstract class Base implements QueryBuilderInterface
{
    public function apply(
        FieldCollection $fieldCollection,
        FormData $formData
    ): void {
        foreach ($fieldCollection as $field) {
            $handler = Factory::create(static::TYPE, $field);
            $handler->apply($this, $field, $formData);
        }
    }
}
