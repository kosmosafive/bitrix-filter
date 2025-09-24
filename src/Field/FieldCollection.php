<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\Field;

use InvalidArgumentException;
use Kosmosafive\Bitrix\DS\Collection;
use Kosmosafive\Bitrix\Filter\ValueObject\FormData;

/**
 * @template-extends Collection<FieldInterface>
 */
class FieldCollection extends Collection
{
    /**
     * @param FieldInterface $value
     *
     * @return $this
     */
    public function add(mixed $value): FieldCollection
    {
        if (!$value instanceof FieldInterface) {
            throw new InvalidArgumentException("This collection only accepts instances of " . FieldInterface::class);
        }

        $this->values[$value->getFieldConfig()->getId()] = $value;

        return $this;
    }

    public function get(string $propertyName): ?FieldInterface
    {
        return $this->values[$propertyName] ?? null;
    }

    public function setFormData(FormData $formData): void
    {
        foreach ($this->values as $field) {
            $field->setFormValue($formData);
        }
    }
}
