<?php
include 'scrapper/govCsvScrapper.php';

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header('Content-Type: application/json');

$govCsvScrapper = new govCsvScrapper("https://www.chp.gov.hk/files/misc/building_list_home_confinees_chi.csv", "home-confinees-building.json");
$results = $govCsvScrapper->scrapContent();
echo $results;
?>