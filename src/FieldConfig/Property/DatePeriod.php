<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\FieldConfig\Property;

readonly class DatePeriod implements PropertyInterface
{
    public function __construct(
        protected string $year = 'YEAR',
        protected string $quarter = 'QUARTER',
        protected string $month = 'MONTH'
    ) {
    }

    public function getYear(): string
    {
        return $this->year;
    }

    public function getQuarter(): string
    {
        return $this->quarter;
    }

    public function getMonth(): string
    {
        return $this->month;
    }
}
