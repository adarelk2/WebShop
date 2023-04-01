<?php
class TimeHelper
{
    private $timezone;
    
    public function __construct($timezone)
    {
        $this->timezone = $timezone;
    }

    public function hoursPassed($datetime)
    {
        $timestamp = strtotime($datetime);
        $hours = ($this->timezone - $timestamp) / 3600;
        return intval($hours);
    }

    public function minutesPassed($datetime)
{
    $timestamp = strtotime($datetime);
    $minutes = ($this->timezone - $timestamp) / 60;
    return intval($minutes);
}
}
?>