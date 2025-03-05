<?php
// app/Services/TimeService.php

namespace App\Services;

class TimeService
{
    /**
     * Format the total time as hours and minutes.
     *
     * @param string $cook_time
     * @param string $prep_time
     * @return string
     */
    public function formatTotalTime($cook_time, $prep_time)
    {
        // Convert time values to integers by removing the "m" suffix
        $cook_time_int = (int) $cook_time;
        $prep_time_int = (int) $prep_time;

        // Calculate the total time in minutes
        $total_time = $cook_time_int + $prep_time_int;

        // If total time is more than 59 minutes, format it as hours and minutes
        if ($total_time >= 60) {
            $hours = floor($total_time / 60);  // Get the hours
            $minutes = $total_time % 60;      // Get the remaining minutes

            return $hours . 'h ' . ($minutes > 0 ? $minutes . 'm' : '');  // Return formatted time
        } else {
            // If less than 60 minutes, just return minutes
            return $total_time . 'm';
        }
    }
}
