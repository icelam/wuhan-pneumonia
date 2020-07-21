<?php
require_once('baseScrapper.php');

class hkLatestSuitationScrapper extends baseScrapper {
  public function __construct() {
    $this->scrap_url = "https://www.chp.gov.hk/files/misc/latest_situation_of_reported_cases_covid_19_chi.csv";
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

      $formattedLastUpdateDate = $latestRecord[0];
      if(preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $latestRecord[0])){
        $date = str_replace('/', '-', $latestRecord[0]);
        $formattedLastUpdateDate = date('Y-m-d', strtotime($date));
      }

      if (!empty($formattedLastUpdateDate) && !empty($latestRecord[1])) {
        $lastUpdate = \DateTime::createFromFormat('Y-m-d H:i', "$formattedLastUpdateDate $latestRecord[1]")->getTimestamp();
      } else if ($formattedLastUpdateDate) {
        $lastUpdate = \DateTime::createFromFormat('Y-m-d', "$formattedLastUpdateDate")->getTimestamp();
      } else {
        $lastUpdate = null;
      }

      $output = array(
        "data"=>$recordPairs, 
        "lastUpdate"=> $lastUpdate
      );

      $api_output = json_encode($output);

      return $api_output;
    } catch (Exception $e) {
      return NULL;
    }
  }
}
?>