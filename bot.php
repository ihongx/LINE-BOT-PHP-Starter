<?php

$strAccessToken = "lyAGuFf9rLfi1EQ3G9fu9gXojgqm6H1vHnnSIfgajnG5FIHNQkuNuMVmCQsqG+Kj4qxlftBrF3zbJ17KlR7Cm2QDoFf69wuXHp3hFI0mADSS6Jw7K88EQJd2f0k+W5WgL9lLQHLR0OJ6LtbmxnZzUwdB04t89/1O/w1cDnyilFU=";

$content = file_get_contents('php://input');
$arrJson = json_decode($content, true);

$strUrl = "https://api.line.me/v2/bot/message/reply";

$arrHeader = array();
$arrHeader[] = "Content-Type: application/json";
$arrHeader[] = "Authorization: Bearer {$strAccessToken}";
$_msg = $arrJson['events'][0]['message']['text'];


$api_key="Po4uAbdSW1jviIjnuq7j_W3GZJiXtN5r";
$url = 'https://api.mlab.com/api/1/databases/duckduck/collections/linebot?apiKey='.$api_key.'';
$json = file_get_contents('https://api.mlab.com/api/1/databases/duckduck/collections/linebot?apiKey='.$api_key.'&q={"question":"'.$_msg.'"}');
$data = json_decode($json);
$isData=sizeof($data);

if (strpos($_msg, 'สอนเป็ด') !== false) {
  if (strpos($_msg, 'สอนเป็ด') !== false) {
    $x_tra = str_replace("สอนเป็ด","", $_msg);
    $pieces = explode("|", $x_tra);
    $_question=str_replace("[","",$pieces[0]);
    $_answer=str_replace("]","",$pieces[1]);
    //Post New Data
    $newData = json_encode(
      array(
        'question' => $_question,
        'answer'=> $_answer
      )
    );
    $opts = array(
      'http' => array(
          'method' => "POST",
          'header' => "Content-type: application/json",
          'content' => $newData
       )
    );
    $context = stream_context_create($opts);
    $returnValue = file_get_contents($url,false,$context);
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = 'ขอบคุณที่สอนเป็ด';
  }
}else{
  if($isData >0){
   foreach($data as $rec){
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = "text";
    $arrPostData['messages'][0]['text'] = $rec->answer;
   }
  }else{
    $arrPostData = array();
    $arrPostData['replyToken'] = $arrJson['events'][0]['replyToken'];
    $arrPostData['messages'][0]['type'] = 'text';
    $arrPostData['messages'][0]['text'] = 'ก๊าบบ คุณสามารถสอนให้ฉลาดได้เพียงพิมพ์: สอนเป็ด[คำถาม|คำตอบ]';
	 $arrPostData['messages'][1]['type'] = 'text';
    $arrPostData['messages'][1]['text'] = 'TEST';
	 $arrPostData['messages'][2]['type'] = "image";
    $arrPostData['messages'][2]['originalContentUrl'] = 'https://raw.githubusercontent.com/ihongx/LINE-BOT-PHP-Starter/master/Capture.JPG';
	$arrPostData['messages'][2]['previewImageUrl'] = 'https://raw.githubusercontent.com/ihongx/LINE-BOT-PHP-Starter/master/Capture.JPG';

	
	
		$arrPostData['messages'][3]['type'] = "location";
		$arrPostData['messages'][3]['title'] = "my location";
		$arrPostData['messages'][3]['address'] = "Bangkok, Thailand";
		$arrPostData['messages'][3]['latitude'] = 35.65910807942215;
		$arrPostData['messages'][3]['longitude'] = 139.70372892916203;
	
	
  }
}




$channel = curl_init();
curl_setopt($channel, CURLOPT_URL,$strUrl);
curl_setopt($channel, CURLOPT_HEADER, false);
curl_setopt($channel, CURLOPT_POST, true);
curl_setopt($channel, CURLOPT_HTTPHEADER, $arrHeader);
curl_setopt($channel, CURLOPT_POSTFIELDS, json_encode($arrPostData));
curl_setopt($channel, CURLOPT_RETURNTRANSFER,true);
curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($channel);
curl_close ($channel);
?>
