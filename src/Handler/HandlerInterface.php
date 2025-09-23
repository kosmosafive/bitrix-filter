<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\Handler;

use Kosmosafive\Bitrix\Filter\Field\FieldInterface;
use Kosmosafive\Bitrix\Filter\QueryBuilder\QueryBuilderInterface;
use Kosmosafive\Bitrix\Filter\ValueObject\FormData;

interface HandlerInterface
{
    public function getType(): string;

    public function apply(
        QueryBuilderInterface $queryBuilder,
        FieldInterface $field,
        FormData $formData
    ): void;
}
