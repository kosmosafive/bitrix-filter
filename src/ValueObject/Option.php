<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\ValueObject;

readonly class Option
{
    public function __construct(
        protected string $id,
        protected string $label
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'label' => $this->label,
        ];
    }
}
