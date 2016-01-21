<?php
// variable definitions
$API_KEY = 'ARa2E-MUinpRZj1CJtoPLJmL8uwIb3pHUjBPExE2NLQ.';
$url = "https://secure.chinavasion.com/api/getProductList.php";
$currency = 'USD';
$categories = 'Android TV Box / Stick';
$start = '0';
$count = '1';
// this constructs the json request sent to the vendor
$data = array(
'key' => $API_KEY,
'currency' => $currency, 
'categories' => [$categories],
'pagination' => ['start' => $start, 'count' => $count]
// I need this to check for the pagination value of Total maybe at EoF? for > 50 
 // if True then kick it out to a sub routine that enters start as +50
  // the max request for most vendors including this on is 50 
);
$content = json_encode($data);
// Communicates header information that formats the response
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-type: application/json"));
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $content);
$json_response = curl_exec($curl);
// need to find out if it's possible to format the response here with specific results from the products array
 // This could help to speed up the action, and possibly neatly deal with field mapping in the future
// Checks the status for an error message in case of failure
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ( $status != 200 ) {
die("Error: call to URL $url failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl));
}
// This still needs to remove the products array format ; and remove the pagination object from EoF
 // Ideally the response should probably be decoded first but this method of writing to file does not work as an array
// Prints response to file
$file = 'file1.json';
$fp = fopen('file1.json', 'w+');
fwrite($fp, $json_response);
fclose($fp);
curl_close($curl);
?>
