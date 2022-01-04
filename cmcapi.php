<?php

$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
$parameters = [
  'start' => '1',
  'limit' => '5000',
  'convert' => 'USD'
];

$headers = [
  'Accepts: application/json',
  'X-CMC_PRO_API_KEY: ' . $_ENV['CMC_API_KEY']
];
$qs = http_build_query($parameters); // query string encode the parameters
$request = "{$url}?{$qs}"; // create the request URL

$curl = curl_init(); // Get cURL resource
// Set cURL options
curl_setopt_array($curl, [
  CURLOPT_URL => $request,            // set the request URL
  CURLOPT_HTTPHEADER => $headers,     // set the headers 
  CURLOPT_RETURNTRANSFER => 1,         // ask for raw response instead of bool

  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,

]);

$response = curl_exec($curl); // Send the request, save the response

// Check if initialization had gone wrong*    
if ($response === false) {
  var_dump([curl_error($curl), curl_errno($curl)]);
}

$file = fopen($cmc_file_name, "w");
fwrite($file, $response);
fclose($file);

curl_close($curl); // Close request

?>