<?php



require "vendor/autoload.php";

$access_token = 'TDe3vkudwX2B0LAAHuXzgXqcQcEWLywJbJwJjT+abMoWCiCnwJTv9oeFfTHhSa33ImWCuQtaF2IzXwb4IP8DRlq2eqeApakA8TXK5n6t0mAHg2oa01SeY6Lv1N6B6INUUl8ppXuA5TDR5LW/ObbaiAdB04t89/1O/w1cDnyilFU=';

$channelSecret = 'b614c4d9cceb1d75c23ae23dc3016cc1';

$pushID = 'U7ef7a449f2a5c2057eacfc02ba2eb286';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







