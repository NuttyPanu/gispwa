<?php
$access_token = 'ZaSUNStHedsjKECFq8pZbaq15CW5M/Ct1RX71FctIJi2HrOtrBNSK+XLiJ6Mp4IfPOMajN2TIH5EzaPL1vdmGO2SDZ+oPrN/Wva9hJ5gHj0iL6lC0cP9UIu8tHPrPzgyL8hTcCZWd8Pb/IyfdWHHBwdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v2/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>
