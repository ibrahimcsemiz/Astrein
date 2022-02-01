<?php

namespace App\Helper;

class TimeHelper
{
    static function convertMinToTime($min)
    {
        $seconds = $min * 60;

        // extract hours

        $hours = floor($seconds / (60 * 60));

        // extract minutes

        $divisorForMinutes = $seconds % (60 * 60);

        $minutes = floor($divisorForMinutes / 60);

        // extract the remaining seconds

        $divisorForSeconds = $divisorForMinutes % 60;

        $seconds = ceil($divisorForSeconds);

        //create string HH:MM:SS

        $hours = strlen($hours) < 2 ? 0 . $hours : $hours;
        $minutes = strlen($minutes) < 2 ? 0 . $minutes : $minutes;
        $seconds = strlen($seconds) < 2 ? 0 . $seconds : $seconds;

        return $hours . ':' . $minutes . ':' . $seconds;
    }
}
