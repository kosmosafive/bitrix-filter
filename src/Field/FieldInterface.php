<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\Field;

use Kosmosafive\Bitrix\Filter\FieldConfig\FieldConfigInterface;
use Kosmosafive\Bitrix\Filter\ValueObject\FormData;
use Stringable;

interface FieldInterface extends Stringable
{
    public function getValue(): mixed;

    public function getFieldConfig(): FieldConfigInterface;

    public function setFormValue(FormData $formData): void;
}
