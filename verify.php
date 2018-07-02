<?php
$access_token = 'AklGxwOyremF+3ylRbytkKDzWvNBp6RHjvZ6nf+itkgDU4RFLdoPeUULnip1HrmEVtFom7cp0zpfixl4Y4S7zBOnpPCadx7/mIasRuQqZGFd242oxeI8YUr3z9PbouCKygMyDXGKfyUrY5+GAL3F/AdB04t89/1O/w1cDnyilFU=';


$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
