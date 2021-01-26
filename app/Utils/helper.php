<?php


if (!function_exists('formatDate')) {
    function formatDate($date, string $format = 'Y/m/d')
    {
        if ($date instanceof \Carbon\Carbon) {
            return $date->format($format);
        }

        return $date;
    }
}
if (!function_exists('arrayColor')) {
    function arrayColor($color)
    {
        $array = ["", "Red", "Blue", "Yellow"];
        return $array[$color];
    }
}
if (!function_exists('FormatMoney')) {
    function FormatMoney($number)
    {
        echo number_format($number, 0, '', ',');
    }
}
