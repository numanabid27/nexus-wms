<?php

use Carbon\Carbon;

if (! function_exists('date_duration')) {

    function date_duration($createdAt, $pickupDate)
    {
        // Dubai timezone
        $timezone = 'Asia/Dubai';

        // created_at stored in UTC → convert to Dubai
        $created = Carbon::parse($createdAt, 'UTC')->setTimezone($timezone);

        // pickup_date already Dubai time → DO NOT convert
        // just tell Carbon what timezone it belongs to
        $pickup = Carbon::parse($pickupDate, $timezone);

        $diff = $created->diff($pickup);

        $parts = [];

        if ($diff->h > 0) {
            $parts[] = $diff->h . ' h';
        }

        if ($diff->i > 0) {
            $parts[] = $diff->i . ' m' ;
        }

        if ($diff->s > 0) {
            $parts[] = $diff->s . ' s';
        }

        // Join with "and" for last item
        if (count($parts) > 1) {
            $last = array_pop($parts);
            return implode(', ', $parts) . ' and ' . $last;
        }

        return $parts[0] ?? '0 seconds';
    }
}
