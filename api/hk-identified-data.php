<?php
include 'scrapper/govCsvScrapper.php';

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/json');

$govCsvScrapper = new govCsvScrapper("https://www.chp.gov.hk/files/misc/enhanced_sur_pneumonia_wuhan_chi.csv", "hk-cases.json");
$results = $govCsvScrapper->scrapContent();
echo $results;
?>