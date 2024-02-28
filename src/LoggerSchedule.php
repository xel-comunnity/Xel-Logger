<?php

namespace Xel\Logger;

enum LoggerSchedule
{
    case Daily;
    case Monthly;
    case Year;

    /**
     * @return array<string|int, mixed>
     */
    public function apply(): array
    {
        return match ($this){
            LoggerSchedule::Daily => ["max" => 7, "format" => "Y-m-d"],
            LoggerSchedule::Monthly => ["max" => 30, "format" => "Y-m"],
            LoggerSchedule::Year => ["max" => 1, "format" => "Y"]
        };
    }
}