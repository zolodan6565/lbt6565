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

    $hello = similar_text("สวัสดี","$message",$percent_hello);
    $hello_2 = similar_text("ดีจ้า","$message",$percent_hello_2);
    $what_time = similar_text("กี่โมงแล้ว","$message",$percent_what_time);

#ตัวอย่าง Message Type "Text"
    if($percent_hello > 60){
	    
	$a=array("อืม หวัดดี","สวัสดีจ้าาา","อืม");
        $random_keys=array_rand($a);
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
	$arrayPostData['messages'][0]['text'] = $a[$random_keys];
	for ($i = 0;$i<100;$i++){
        	replyMsg($arrayHeader,$arrayPostData);
    	}
    }
    else if($percent_hello_2 > 60){
	$a=array("อืม หวัดดี","ใครทักมาละนั้น","หวัดดีลูกหวัดดี","อย่าทัก! กำลังกินอยู่","อันยองฮาเซโย");
        $random_keys=array_rand($a);
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = $a[$random_keys];
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
	$a=array("หาไรกินสิครับ 555","สงสัยต้องเมนูอาหารญี่ปุ่นละ","มาม่าเถอะลูก","อืม แล้ว?");
        $random_keys=array_rand($a);
		
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = $a[$random_keys];
        replyMsg($arrayHeader,$arrayPostData);
    }
	
else if ($percent_what_time > 60){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = date("H โมง i นาที s วินาที");
        replyMsg($arrayHeader,$arrayPostData);
    }
/*else if ($message == "vdo"){
         $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "video";
        $arrayPostData['messages'][0]['originalContentUrl'] = "http://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4";//ใส่ url ของ video ที่ต้องการส่ง
        $arrayPostData['messages'][0]['previewImageUrl'] = "https://upload.wikimedia.org/wikipedia/th/b/bd/%E0%B9%82%E0%B8%94%E0%B8%A3%E0%B8%B2%E0%B9%80%E0%B8%AD%E0%B8%A1%E0%B8%AD%E0%B8%99.png";//ใส่รูป preview ของ video
        replyMsg($arrayHeader,$arrayPostData);
    }*/
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
