<?php

// Function to format just the date
function formatDate($date, $format = "F j, Y") {
    return date($format, strtotime($date));
}

// Function to format just the time
function formatTime($time) {
    $timeObj = DateTime::createFromFormat('H:i:s', $time);
    return $timeObj ? $timeObj->format('h:i A') : '';  // Format as 12-hour time (e.g., 11:30 AM)
}

// Function to format just the date and time
function formatDateTime($date, $time, $format = "F j, Y g:i A") {
    return date($format, strtotime("$date $time"));
}


