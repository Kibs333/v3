<?php

function timestamp(){
// Set the default timezone to Nairobi, Kenya
date_default_timezone_set('Africa/Nairobi');
// Get the current date and time
$currentDateTime = date('Y-m-d H:i:s');
return $currentDateTime;
}

function windowLocation($time, $location) {echo '<script>setTimeout(function() {window.location.href = "' . $location . '";}, ' . $time . ')</script>';}