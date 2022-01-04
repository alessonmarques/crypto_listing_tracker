<?php
ini_set('error_reporting', E_ALL);

require __DIR__ . '/vendor/autoload.php';
new \App\Support\Environment();


$cmc_file_name = "./result.json";
if (!file_exists($cmc_file_name)) {
  include_once("cmcapi.php");
}

include_once("cmcresult.php");

?>