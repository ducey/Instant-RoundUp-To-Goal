<?php

// Put your Starling Developer Token id here.
// It must have this scope:
// savings-goal:read

$bearer = "" ;


// Connect to Starling
$authorization = "Authorization: Bearer " . $bearer;
$process = curl_init("https://api.starlingbank.com/api/v1/savings-goals");
curl_setopt($process, CURLOPT_HTTPHEADER, array(
    $authorization)                                                           
);
curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
$starling = curl_exec($process);
curl_close($process);
$starlingDeets = json_encode($starling);
echo $starlingDeets;

?>
