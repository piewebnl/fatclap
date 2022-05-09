<?php

namespace App\Helpers;

class DateHelper
{

    // Add date after x number of days from a given a date (formatted as YYYY-MM-DD)
    public static function getDateByXNumberOfDays(string $date, int $numberOfDays = 1): ?string
    {
        $dateTime = \DateTime::createFromFormat("Y-m-d", $date);

        if ($dateTime !== false and !array_sum($dateTime::getLastErrors())) {
            $seperate = explode('-', $date);
            $dateTime->setDate($seperate[0], $seperate[1], $seperate[2]);
            $dateTime->modify("+{$numberOfDays} days");
            return $dateTime->format('Y-m-d');
        }
        return null;
    }
}
