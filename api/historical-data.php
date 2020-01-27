<?php
// ini_set("display_errors", 1);
// error_reporting(E_ALL);

include 'scrapper/qqNewsScrapper.php';

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/json');
// header('Access-Control-Allow-Origin: *');

$qqNewsScrapper = new qqNewsScrapper();
$results = $qqNewsScrapper->scrapContent();
echo $results;
?>