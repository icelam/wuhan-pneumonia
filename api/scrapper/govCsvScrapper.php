<?php
require_once('baseScrapper.php');

class govCsvScrapper extends baseScrapper {
  public function __construct($target_url, $target_file_name) {
    $this->scrap_url = $target_url;
    $this->store_folder = "scraps";
    $this->store_filename = $target_file_name;
  }
  
  public function postProcessing($data) {
    try {   
      // Remove BOM characters and trim trailing new line
      $bom_removed = preg_replace("/^\xef\xbb\xbf/", '', rtrim($data));

      // Transform CSV to JSON
      $csvRecord = array_map("str_getcsv", explode("\n", $bom_removed));
      $api_output = json_encode($csvRecord);

      return $api_output;
    } catch (Exception $e) {
      return NULL;
    }
  }
}
?>