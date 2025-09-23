<?php

declare(strict_types=1);

namespace Kosmosafive\Bitrix\Filter\ValueObject;

readonly class Range
{
    protected mixed $from;
    protected mixed $to;

    public function __construct(
        mixed $from = null,
        mixed $to = null
    ) {
        if ($from && $to && ($from > $to)) {
            $temp = $to;
            $to = $from;
            $from = $temp;
        }

        $this->from = $from;
        $this->to = $to;
    }

    public function getFrom(): mixed
    {
        return $this->from;
    }

    public function getTo(): mixed
    {
        return $this->to;
    }

    public function isEmpty(): bool
    {
        return ($this->from === null) && ($this->to === null);
    }
}
