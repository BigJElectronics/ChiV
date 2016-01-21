<?php
$API_KEY = 'ARa2E-MUinpRZj1CJtoPLJmL8uwIb3pHUjBPExE2NLQ.';
$url = "https://secure.chinavasion.com/api/getProductList.php";
$data = array(
'key' => $API_KEY,
'currency' => 'USD',
'categories' => ['Android TV Box / Stick'],
'pagination' => ['start' => '0', 'count' => '1']
);
$content = json_encode($data);
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
$json_response = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ( $status != 200 ) {
die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}
$file = 'file1.json';
/* Proposed section to pre-format the data
 / The previous line would be wiped out with $f = fopen($csvFilePath,'w+');
  / The line following this code would be replaced by a convert straight to csv
$firstLineKeys = false;
foreach ($json_response as $line)
{
        if (empty($firstLineKeys))
        {
                $firstLineKeys = array_keys($line);
                fputcsv($f, $firstLineKeys);
                $firstLineKeys = array_flip($firstLineKeys);
        }
        // Using array_merge is important to maintain the order of keys acording to the first element
        fputcsv($f, array_merge($firstLineKeys, $line));
}
*/
file_put_contents($file, $json_response);
curl_close($curl);
?>
