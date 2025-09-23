<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\FieldConfig;

interface FieldConfigInterface
{
    public function getProperty(): Property\PropertyInterface;

    public function getId(): string;
}
