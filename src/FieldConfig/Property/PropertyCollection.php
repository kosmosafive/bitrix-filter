<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\FieldConfig\Property;

use Kosmosafive\Bitrix\DS\Collection;

/**
 * @template-extends Collection<PropertyInterface>
 */
class PropertyCollection extends Collection
{
    public function __construct(PropertyInterface ...$properties)
    {
        parent::__construct(...$properties);
    }
}
