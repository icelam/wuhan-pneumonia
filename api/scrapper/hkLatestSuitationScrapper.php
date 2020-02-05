<?php
require_once('baseScrapper.php');

class hkLatestSuitationScrapper extends baseScrapper {
  public function __construct() {
    $this->scrap_url = "https://www.chp.gov.hk/files/misc/latest_situation_of_reported_cases_wuhan_chi.csv";
    $this->store_folder = "scraps";
    $this->store_filename = "latest-suitation.csv";
  }
  
  public function postProcessing($data) {
    try {   
      // Remove BOM characters and trim trailing new line
      $bom_removed = preg_replace("/^\xef\xbb\xbf/", "", rtrim($data));

      // Transform CSV to JSON
      $csvRecord = array_map("str_getcsv", explode("\n", $bom_removed));
      $csvLength = sizeof($csvRecord);

      $recordLabel = $csvRecord[0];
      $latestRecord = $csvRecord[$csvLength - 1];

      $recordPairs = [];

      foreach ($recordLabel as $index=>$label) {
        if ($index > 1) {
          $currentPair = array("label"=>$label, "count"=>$latestRecord[$index]);
          array_push($recordPairs, $currentPair);
        }
      }

      $output = array(
        "data"=>$recordPairs, 
        "lastUpdate"=> \DateTime::createFromFormat('d/m/Y H:i', "$latestRecord[0] $latestRecord[1]")->getTimestamp()
      );

      $api_output = json_encode($output);

      return $api_output;
    } catch (Exception $e) {
      return NULL;
    }
  }
}
?>