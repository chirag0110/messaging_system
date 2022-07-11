<?php


function convertUtcDatetoLocal($olddate)
{
    $timezone =   @$_COOKIE['myTimeZone'] ? @$_COOKIE['myTimeZone'] : 'America/Denver';
    $date = new DateTime($olddate);
    $date->setTimezone(new DateTimeZone($timezone));
    return $date = date_format($date, 'Y-m-d H:i:s');
}
