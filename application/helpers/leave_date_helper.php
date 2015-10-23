<?php

defined('BASEPATH') or exit('No direct script access allowed');

function getNoOfDaysBetweenTwoDates($start_date, $end_date)
{

    $start_date = strtotime($start_date);
    $end_date   = strtotime($end_date);

    if ($start_date>$end_date) {
        $datediff = $start_date-$end_date;
    } else {
        $datediff = $end_date-$start_date;
    }
    $no_of_days = floor($datediff/(60*60*24));
}
function businessWorkingDays($start_date, $end_date, $show_days = FALSE)
{
  
    $workingDays = 0;
    $date_array =array();
    $days = array();
    $startTimestamp = strtotime($start_date);
    $endTimestamp = strtotime($end_date);
     
    for ($i=$startTimestamp; $i<=$endTimestamp; $i = $i+(60*60*24)) {
        if (date("N", $i) <= 5) {
            $workingDays = $workingDays + 1;
            $days[] = date('Y-m-d', $i);
        }
    }
    if ($show_days) {
        return $days;
    } else {
        return $workingDays;
    }
}
function convertDbDate($date)
{

    $converted_date = date('d-m-Y', strtotime($date));
    return $converted_date;
}
