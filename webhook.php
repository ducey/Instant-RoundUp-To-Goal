<?php
$json = file_get_contents('php://input'); 
$response = json_decode($json);


// Starling Personal Access Token
$starlingPAT = "";

// RoundUps Savings Goal UID
$savingsGoalUID = "";

// Email Address
$emailAddress = "";




$amnt = abs(number_format((float)$response->{'content'}->{'amount'}, 2, '.', ''));

$diff = ceil($amnt) - $amnt;
$starlingTotalRoundUps = $diff;


// transfer to goal
// Connect to Starling
$authorization = "Authorization: Bearer " . $starlingPAT;

// savings-goals
$putUrl = "https://api.starlingbank.com/api/v1/savings-goals/" . $savingsGoalUID . "/add-money/". 
unique_id(8). "-". 
unique_id(4). "-". 
unique_id(4). "-". 
unique_id(4). "-". 
unique_id(12);

$process = curl_init($putUrl);
$data = array('currency' => 'GBP','minorUnits' => $starlingTotalRoundUps * 100);
$payload = json_encode( array ('amount' => $data)  ); 


curl_setopt($process, CURLOPT_HEADER, true);
// curl_setopt($process, CURLINFO_HEADER_OUT, true);
curl_setopt($process, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($process, CURLOPT_POSTFIELDS, $payload);
curl_setopt($process, CURLOPT_RETURNTRANSFER, true);
curl_setopt($process, CURLOPT_HTTPHEADER,
               array('Content-Type: application/json',
                     'Accept: application/json',
                     'Expect: 100-continue', 
                      'Content-Length: ' . strlen($payload),
                      $authorization)
);
$savingsGoals = curl_exec($process);

curl_close($process);

mail($emailAddress,"RoundUps","You've just saved £". number_format((float)$starlingTotalRoundUps, 2, '.', ''). 
" in to your RoundUps!");


function unique_id($l = 8) {
    return substr(md5(uniqid(mt_rand(), true)), 0, $l);
}

?>
