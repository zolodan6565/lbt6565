<?php
$access_token = 'Vexuc4YGwb4zAIyA6HfOsQGrIWDRWUMTIGxuAAkpCu0q/8zXubJdLlcxyMY06GFuImWCuQtaF2IzXwb4IP8DRlq2eqeApakA8TXK5n6t0mDqc9nwLXykd5x9BL5xLfq8cn6zJbym2Zj8xj47Bn2AwAdB04t89/1O/w1cDnyilFU=
';


$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;