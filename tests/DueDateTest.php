<?php

namespace Tests\DueDate;

use Kardasz\DueDate\DueDate;
use PHPUnit\Framework\TestCase;

class DueDateTest extends TestCase
{
    public function testDueDate()
    {
        $start = new DueDate(new \DateTimeImmutable('2021-01-01'));

        $currentDueDate = $start->currentDueDate(new \DateTimeImmutable('2021-01-31'))->format('Y-m-d');

        $this->assertEquals('2021-01-01', $currentDueDate);

        $nextDueDate = $start->nextDueDate(new \DateTimeImmutable('2021-01-31'))->format('Y-m-d');

        $this->assertEquals('2021-02-01', $nextDueDate);
    }
}
