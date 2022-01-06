<?php
ini_set('error_reporting', E_ALL);

require __DIR__ . '/vendor/autoload.php';
new \App\Support\Environment();

$core = "cg";

$file_name = "./results/result.json";
if (!file_exists($file_name)) {
  
  if ($core == 'cmc') {
    include_once("cmcapi.php");
  }

  if ($core == 'cg') {
    include_once("cgapi.php");
  }
  
}

include_once("result.php");

?>