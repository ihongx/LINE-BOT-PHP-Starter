<?php
$access_token = 'LSSCN/p3/lhdozDF8tABB70GY4vMlLFBcX/oacNQoUOE4Qw9Qd5G684vwkieb0WZKaARBB5GLk1/COCvyVgge4RSunJsU6GAuuMCXOfiAYd/9wriXor92gifDvBJe/FV5mT7fcEelqg9OegXelzHEAdB04t89/1O/w1cDnyilFU=';

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
			$text = $event['message']['text'];
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
/*
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
			*/
			
			$img = [
				'replyToken' => $replyToken,
				'imageFile' => '@/capture.jpg',
			];
			
	define('LINE_API',"https://notify-api.line.me/api/notify");
$token = "LSSCN/p3/lhdozDF8tABB70GY4vMlLFBcX/oacNQoUOE4Qw9Qd5G684vwkieb0WZKaARBB5GLk1/COCvyVgge4RSunJsU6GAuuMCXOfiAYd/9wriXor92gifDvBJe/FV5mT7fcEelqg9OegXelzHEAdB04t89/1O/w1cDnyilFU="; //ใส่Token ที่copy เอาไว้
$str = "Hello"; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
$stickerPkg = 2; //stickerPackageId
$stickerId = 34; //stickerId
 
$res = notify_message($str,$stickerPkg,$stickerId,$token);
print_r($res);
function notify_message($message,$stickerPkg,$stickerId,$token){
     $queryData = array(
      'message' => $message,
      'stickerPackageId'=>$stickerPkg,
      'stickerId'=>$stickerId
     );
     $queryData = http_build_query($queryData,'','&');
     $headerOptions = array(
         'http'=>array(
             'method'=>'POST',
             'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                 ."Authorization: Bearer ".$token."\r\n"
                       ."Content-Length: ".strlen($queryData)."\r\n",
             'content' => $queryData
         ),
     );
     $context = stream_context_create($headerOptions);
     $result = file_get_contents(LINE_API,FALSE,$context);
     $res = json_decode($result);
  return $res;
 }
			
			
			
			
			
		}
	}
}
echo "Not OK";











?>

