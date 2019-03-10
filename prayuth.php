<?php
// linegroup เพื่อนกัน = C3158cdbf445f182ffc3b6449cb1e32bc
// เชี้ยง = U462e92e0413e480628758891b6d4161e
//idgrup = C9a63307214226ae2aab8f45ea725be1b
    $accessToken = "lyAGuFf9rLfi1EQ3G9fu9gXojgqm6H1vHnnSIfgajnG5FIHNQkuNuMVmCQsqG+Kj4qxlftBrF3zbJ17KlR7Cm2QDoFf69wuXHp3hFI0mADSS6Jw7K88EQJd2f0k+W5WgL9lLQHLR0OJ6LtbmxnZzUwdB04t89/1O/w1cDnyilFU=";//
    
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
     //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];
#ตัวอย่าง Message Type "Text"
    if((strpos($message,"ประยุทธ์")!==FALSE||strpos($message,"ประยุด")!==FALSE||strpos($message,"ปะยุด")!==FALSE||strpos($message,"ประย")!==FALSE||strpos($message,"ปะย")!==FALSE) && strlen($message)<30){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีครับ อยากดูรูปอะไร ลองพิมพ์ตามนี้ เช่น ประยุดขอรูปแตดหน่อย";
       
        replyMsg($arrayHeader,$arrayPostData);
    }

     else  if((strpos($message,"ประเยด")!==FALSE||strpos($message,"ประเย็ด")!==FALSE||strpos($message,"ปะเยด")!==FALSE||strpos($message,"ประเยด")!==FALSE||strpos($message,"ปะเย")!==FALSE||strpos($message,"ประเย")!==FALSE)&&strlen($message)<30){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "เรียกผมสุภาพหน่อยนะครับ ผมประยุดไม่ใช่$message \r\n\r\n อยากดูรูปอะไร พิมพ์ตามนี้ เช่น ประยุดขอรูปหีหน่อย";
        replyMsg($arrayHeader,$arrayPostData);
    }
    
         else  if((strpos($message,"ควย")!==FALSE||strpos($message,"เหี้ย")!==FALSE)&&strlen($message)<30){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "ด่าผมได้ผมไม่โกรธครับ \r\n\r\n อยากดูรูปอะไร พิมพ์ตามนี้ เช่น ประยุดขอรูปนมใหญ่ๆหน่อย";
        replyMsg($arrayHeader,$arrayPostData);
    }
         else  if((strpos($message,"มึง")!==FALSE||strpos($message,"ไอโง่")!==FALSE)&&strlen($message)<30){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "เรียกผมเพราะๆนะครับ \r\n\r\n อยากดูรูปอะไร ลองพิมพ์ตามนี้ เช่น ประยุดขอรูปหอยสวยๆหน่อย";
        replyMsg($arrayHeader,$arrayPostData);
    }

   
    else if((strpos($message,'ประยุด ขอรูป')!==FALSE ||
        strpos($message,'ประยุดขอรูป')!==FALSE)  && strlen($message)>24){

        $message = str_replace('ประยุด', '', $message);
        $message = str_replace('หน่อย', '', $message);
        $message = str_replace('ขอ', '', $message);
        $message = str_replace('รูป', '', $message);
        $message = trim($message);

        $image_url =_string($message);
       // $image_url ='https://www.tamtid.com/wp-content/uploads/2018/10/1-8.jpg';
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
    }
 

 function _string($message)
 {

    $string = urlencode($message);
    $url    ="https://www.google.com/search?q=$string";
    $result =  file_get_contents($url);
    $xpath =_getXpath($result);

    $results = $xpath->query('//tr[@style="position:relative"]');
    print_r($results);
    $TAG=$results[0]->getElementsByTagName('a');
    print_r($TAG);
     foreach( $TAG as $tag)
     {
          if(strpos($tag->nodeValue,'ค้นรูป')!==FALSE)
          {
            $link = $tag->getAttribute('href');
            $link ='https://www.google.com'.$link;
        
            $result =  file_get_contents($link);
            $xpath =_getXpath($result);
            $results = $xpath->query('//img[contains(@alt,"'.$message.'")]');
            print_r($results);
            $no = rand(0,19);
            $pic =$results[$no]->getAttribute('src');
/*
            $x =$results[15]->parentNode;
            $x =$x->getAttribute('href');
            preg_match('|(https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*))&\w+|', $x,$match);
            print_r($match);

            echo $match[0];
            $link = explode("&sa=",$match[0]);
           
            echo $link[0];
            $result =  file_get_contents($link[0]);
            $xpath  =_getXpath($result);

            $results = $xpath->query('//img[contains(@src,".jpg")]');
            print_r($results);
           echo $pic     = urldecode($results[0]->getAttribute('src'));
*/
            return $pic;
          }


     }


 }

function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);

    }


    function getId($arrayHeader){
        $strUrl = "https://api.line.me/v2/bot/group/C9a63307214226ae2aab8f45ea725be1b/members/ids";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
        return $result;
    }



function _getXpath($result)
{
    $doc = new DOMDocument;
    libxml_use_internal_errors(true);
    $doc->loadHTML($result);
    libxml_clear_errors(); //remove errors for yucky html
    $xpath = new DOMXPath($doc);
    return $xpath;
}

function _send_request($request,$url,$header,$data,$cookie,$return,$follow)
{
    $proxy="127.0.0.1:8888" ;   
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_PROXY, $proxy); 
    curl_setopt($ch,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
    curl_setopt($ch,CURLOPT_HTTPHEADER,$header);
    curl_setopt($ch,CURLOPT_URL, $url); 
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, $return); 
    curl_setopt($ch,CURLOPT_TIMEOUT, 30000); 
    curl_setopt($ch,CURLOPT_FOLLOWLOCATION, $follow); 
    curl_setopt($ch,CURLOPT_CUSTOMREQUEST, $request); 
    curl_setopt($ch,CURLOPT_POSTFIELDS, $data); 
    curl_setopt($ch,CURLOPT_COOKIEJAR , $cookie); 
    curl_setopt($ch,CURLOPT_COOKIEFILE, $cookie); 
    curl_setopt($ch,CURLOPT_COOKIESESSION, 0);  // แก้ปัญญา โพสไม่ผ่าน แก้จาก 1 เป็น 0 
    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POSTREDIR, 3);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, 2);
    if(curl_errno($ch)) 
    {
    print_r(curl_error($ch));
    die();
    }
      $result  = curl_exec($ch);
      curl_close($ch);
      return $result;
}

   exit;
?>