<?php

use App\Http\Helpers\Calendar;

if (!function_exists('excerpt')) {
    function excerpt($text, $long = 25)
    {
        return strlen($text) <= $long ? $text : mb_substr($text, 0, $long) . '...';
    }
}

if (!function_exists('calendar')) {
    function calendar()
    {
        return new Calendar;
    }
}