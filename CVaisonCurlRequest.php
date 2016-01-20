<?php

$API_KEY = 'ARa2E-MUinpRZj1CJtoPLJmL8uwIb3pHUjBPExE2NLQ.';

$url = "https://secure.chinavasion.com/api/getProductList.php";

$data = array(

'key' => $API_KEY,

'currency' => 'USD',

'categories' => ['Android TV Box / Stick'],

);

$content = json_encode($data);

// REM for testing echo "<blockquote>"; var_dump($content); echo "</blockquote>";

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_HEADER, false);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));

curl_setopt($curl, CURLOPT_POST, true);

curl_setopt($curl, CURLOPT_POSTFIELDS, $content);

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$json_response = curl_exec($curl);

$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if ( $status != 200 ) {

die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));

}


$file = 'file1.json';

file_put_contents($file, $json_response);

$fp = fopen('file1.json', 'w+');

fwrite($fp, $json_response);

fclose($fp);

curl_close($curl);

$response = json_decode($json_response, true);

// REM for testing echo "<blockquote>"; var_dump($response); echo "</blockquote>";

?>
