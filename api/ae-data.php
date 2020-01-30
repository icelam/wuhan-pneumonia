<?php
include 'scrapper/haGovScrapper.php';

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/json');

$haGovScrapper = new haGovScrapper();
$results = $haGovScrapper->scrapContent();
echo $results;
?>