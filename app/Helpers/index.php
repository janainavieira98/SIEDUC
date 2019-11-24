<?php

use Illuminate\Support\Carbon;

if (!function_exists('sortWeekdays')) {
    function sortWeekdays($collection) {
        return $collection->sortBy(function($period) {
            $date = Carbon::createFromFormat('l', ucfirst($period['slug']))->weekday();
            return $date;
        });
    }
}
