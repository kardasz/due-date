<?php

namespace Kardasz\DueDate;

use Carbon\CarbonImmutable;

readonly class DueDate
{
    private CarbonImmutable $startBillingDate;

    public function __construct(\DateTimeInterface $startBillingDate)
    {
        $this->startBillingDate = new CarbonImmutable($startBillingDate);
    }

    public function periods(?\DateTimeInterface $now = null): int
    {
        $now = new CarbonImmutable($now ?? 'now');
        if ($this->startBillingDate->day > $now->daysInMonth) {
            return $this->startBillingDate
                ->subDays($this->startBillingDate->day-$now->daysInMonth)
                ->diffInMonths($now);
        }

        return floor($this->startBillingDate->diffInMonths($now));
    }

    public function currentDueDate(?\DateTimeInterface $now = null): \DateTimeImmutable
    {
        return $this->startBillingDate
            ->addMonthsNoOverflow($this->periods($now));
    }

    public function nextDueDate(?\DateTimeInterface $now = null): \DateTimeImmutable
    {
        return $this->startBillingDate
            ->addMonthsNoOverflow($this->periods($now) +1);
    }
}
