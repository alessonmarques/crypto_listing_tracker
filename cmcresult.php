<?php 
$json = file_get_contents($cmc_file_name);
$json_data = json_decode($json, true);

echo "<pre>";
print_r($json_data);

?>