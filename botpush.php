<?php



require "vendor/autoload.php";

$access_token = 'AklGxwOyremF+3ylRbytkKDzWvNBp6RHjvZ6nf+itkgDU4RFLdoPeUULnip1HrmEVtFom7cp0zpfixl4Y4S7zBOnpPCadx7/mIasRuQqZGFd242oxeI8YUr3z9PbouCKygMyDXGKfyUrY5+GAL3F/AdB04t89/1O/w1cDnyilFU=';

$channelSecret = '1ca3d4f6259fa05c8103c916eac88eb6';

$pushID = 'U0954bd96fe543817013f1d5ae9998a54';


$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

//Get Data Post From URL.
$Get_Data = $_GET['data'];

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($Get_Data);
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody() . ' ' . $response->$Get_Data;







