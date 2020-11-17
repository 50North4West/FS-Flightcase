<?php

function readableDate($date, $format) {

  $returnDate = date($format, strtotime($date));

  return $returnDate;
}

//echo time_to_decimal("25"); ==
function minutes_to_decimal($minutes) {
    $decTime = $minutes / 60;
    $decTime = $decTime * 100;
    return $decTime;
}

//echo time_to_decimal("25"); ==
function minutes_to_time($minutes) {
    $decTime = $minutes * 100;
    $decTime = $decTime * 60;
    return $decTime;
}


