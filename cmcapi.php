<?php

/*
  "sort" must be one of [name, symbol, date_added, market_cap, market_cap_strict, price, circulating_supply, total_supply, max_supply, num_market_pairs, volume_24h, percent_change_1h, percent_change_24h, percent_change_7d, market_cap_by_total_supply_strict, volume_7d, volume_30d]
*/

/*
  $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
  // Recently added crypto currencies.
  $parameters = [
    'start' => '1',
    'limit' => '50',
    'convert' => 'USD',
    'sort' => 'date_added',
    'sort_dir' => 'desc',
  ];
*/

$url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/listings/latest';
// Recently added crypto currencies.
$parameters = [
  'start' => '5000',
  'limit' => '5000',
  'sort' => 'num_market_pairs',
  'sort_dir' => 'asc',
];

/*
  $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
  // Recently turned to visible currencies.
  $parameters = [
    'symbol' => 'SHIBADOLLARS',
  ];
*/

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