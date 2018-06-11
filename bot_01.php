<?php
    date_default_timezone_set("Asia/Bangkok");
    $accessToken = "TDe3vkudwX2B0LAAHuXzgXqcQcEWLywJbJwJjT+abMoWCiCnwJTv9oeFfTHhSa33ImWCuQtaF2IzXwb4IP8DRlq2eqeApakA8TXK5n6t0mAHg2oa01SeY6Lv1N6B6INUUl8ppXuA5TDR5LW/ObbaiAdB04t89/1O/w1cDnyilFU=";//copy Channel access token ตอนที่ตั้งค่ามาใส่
  
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    
    //รับข้อความจากผู้ใช้
    $message = $arrayJson['events'][0]['message']['text'];
#ตัวอย่าง Message Type "Text"
    if($message == "สวัสดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "สวัสดีจ้าาา";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Sticker"
    else if($message == "ฝันดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "2";
        $arrayPostData['messages'][0]['stickerId'] = "46";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Image"
    else if($message == "รูปน้องแมว"){
        $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Location"
    else if($message == "พิกัดสยามพารากอน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
        $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
        $arrayPostData['messages'][0]['latitude'] = "13.7465354";
        $arrayPostData['messages'][0]['longitude'] = "100.532752";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
    else if($message == "ลาก่อน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "1";
        $arrayPostData['messages'][1]['stickerId'] = "131";
        replyMsg($arrayHeader,$arrayPostData);
    }
 else if($message == "ถูกหวย"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "ห้ะ! เอามาแบ่งบ้างดิ หึหึหึหึ";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "2";
        $arrayPostData['messages'][1]['stickerId'] = "515";
        replyMsg($arrayHeader,$arrayPostData);
    }
else if($message == "หิวจุง"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "หาไรกินสิครับ 555";
        replyMsg($arrayHeader,$arrayPostData);
    }
else if ($message == "กี่โมงแล้ว"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = date("H โมง i นาที s วินาที");
        replyMsg($arrayHeader,$arrayPostData);
    }
else if ($message == "vdo"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "video";
        $arrayPostData['messages'][0]['originalContentUrl'] = "https://youtu.be/PMivT7MJ41M";//ใส่ url ของ video ที่ต้องการส่ง
        $arrayPostData['messages'][0]['previewImageUrl'] = "data:image/png;base64,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";//ใส่รูป preview ของ video
        replyMsg($arrayHeader,$arrayPostData);
    }
else {
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "ผมงงอ่ะ พิมพ์ใหม่ได้ป่ะ";
        replyMsg($arrayHeader,$arrayPostData);
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
   exit;
?>
