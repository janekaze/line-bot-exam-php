<?php // callback.php
//date_default_timezone_set('UTC');
require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'AklGxwOyremF+3ylRbytkKDzWvNBp6RHjvZ6nf+itkgDU4RFLdoPeUULnip1HrmEVtFom7cp0zpfixl4Y4S7zBOnpPCadx7/mIasRuQqZGFd242oxeI8YUr3z9PbouCKygMyDXGKfyUrY5+GAL3F/AdB04t89/1O/w1cDnyilFU=';
$User_Token = '794GVAyhWqChqCwXnUTVgXrmWOtlWVeAKEj6msS6J7F';
$channelSecret = '1ca3d4f6259fa05c8103c916eac88eb6';
$User_ID = 'U0954bd96fe543817013f1d5ae9998a54';
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);

// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			//Convert TimeStamp.
			$epoch = $event['timestamp'] + 25200;
			$dt = date('H:i:s', $epoch);
			$text = $dt . "\r\n " . 'Your iD: ' . $event['source']['userId'];
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
		if ($event['type'] == 'message' && $event['message']['type'] == 'image') {
			$MSG_ID = 'MSG ID: ' . $event['message']['id'];
			$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
			$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
			$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder($MSG_ID);
			$response = $bot->pushMessage($User_ID, $textMessageBuilder);	
			\LINE\LINEBot\HTTPClient\CurlHTTPClient('<channel access token>');
			//Get Content in to Drive.
			$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
			$response = $bot->getMessageContent($event['message']['id']);
			if ($response->isSucceeded()) {
			    $tempfile = tmpfile();
			    fwrite($tempfile, $response->getRawBody());
			} else {
			    error_log($response->getHTTPStatus() . ' ' . $response->getRawBody());
			}
		}
	}
}
echo "OK";
