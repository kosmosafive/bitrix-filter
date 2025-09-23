<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\ValueObject;

readonly class DatePeriod
{
    public function __construct(
        protected ?int $year = null,
        protected ?int $quarter = null,
        protected ?int $month = null
    ) {
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function getQuarter(): ?int
    {
        return $this->quarter;
    }

    public function getMonth(): ?int
    {
        return $this->month;
    }

    public function isEmpty(): bool
    {
        return $this->getYear() === null;
    }
}
