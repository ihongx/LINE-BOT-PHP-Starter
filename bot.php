

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
		

	//	$data = [
	//			'replyToken' => $replyToken,
	//			'messages' => [$messages],
	//		];
			
			
//**********************************************	

	$post={
	//	"messgaes" : $messages,
	//	"replyToken":$replyToken,
  "type": "template",
  "altText": "this is a buttons template",
  "template": {
      "type": "buttons",
      "thumbnailImageUrl": "https://www.google.co.th/url?sa=i&rct=j&q=&esrc=s&source=images&cd=&cad=rja&uact=8&ved=0ahUKEwia6OK66vTVAhWIwI8KHQjXCKoQjRwIBw&url=https%3A%2F%2Fwww.royalcanin.com%2Fproducts%2Fdog%2Fmedium&psig=AFQjCNFC17p_SgVP0CReb4lyNZ-EvqHp1Q&ust=1503834563250208",
      "title": "Menu",
      "text": "Please select",
      "actions": [
          {
            "type": "postback",
            "label": "Buy",
            "data": "action=buy&itemid=123"
          },
          {
            "type": "postback",
            "label": "Add to cart",
            "data": "action=add&itemid=123"
          },
          {
            "type": "uri",
            "label": "View detail",
            "uri": "http://www.google.co.th"
          }
      ]
  }
}



//*************************************************************
			
			
	
		
			
			
			
			
		//	$post = json_encode($data);
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
echo "OK";

?>


			
		
		