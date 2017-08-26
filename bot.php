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
			
/*	$images = [	
    "type"=> "image",
    "originalContentUrl"= "https://www.google.co.th/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwjom53Y8PTVAhWBp48KHaexDO8QjRwIBw&url=https%3A%2F%2Fwww.cesarsway.com%2Fdog-behavior&psig=AFQjCNE_fAT2zKTT06zKO96nIK5_Dy1sOA&ust=1503836235912612",
    "previewImageUrl"= "https://www.google.co.th/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwiUvf7i8PTVAhVCpY8KHRjSAIEQjRwIBw&url=http%3A%2F%2Fwww.powerlifetothemax.com%2F%3Fp%3D1624&psig=AFQjCNE_fAT2zKTT06zKO96nIK5_Dy1sOA&ust=1503836235912612"
];
			
*/
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
				//'images' =>[$images]
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
	}
}
echo "I am Hong";
?>

			
		
		