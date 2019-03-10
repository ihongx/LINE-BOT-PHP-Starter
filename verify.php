<?php
$access_token = 'lyAGuFf9rLfi1EQ3G9fu9gXojgqm6H1vHnnSIfgajnG5FIHNQkuNuMVmCQsqG+Kj4qxlftBrF3zbJ17KlR7Cm2QDoFf69wuXHp3hFI0mADSS6Jw7K88EQJd2f0k+W5WgL9lLQHLR0OJ6LtbmxnZzUwdB04t89/1O/w1cDnyilFU=';
$url = 'https://api.line.me/oauth2/v2.1/verify?access_token='.$access_token;

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>
