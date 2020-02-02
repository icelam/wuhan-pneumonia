<?php
require_once('baseScrapper.php');

class qqNewsScrapper extends baseScrapper {
  public function __construct() {
    $this->scrap_url = "https://view.inews.qq.com/g2/getOnsInfo?name=wuwei_ww_cn_day_counts";
    $this->store_folder = "scraps";
    $this->store_filename = "historical.json";
  }
  
  public function postProcessing($data) {
    try {   
      // Extract data needed
      $extracted_data = $this->jsonExtract("data", $data);

      if (!empty($data)) {
        // Form api output
        $output_data = [
          "status" => 200,
          "data" => $extracted_data,
        ];

        $api_output = json_encode($output_data);

        return $api_output;
      } else {
        return NULL;
      }
    } catch (Exception $e) {
      return NULL;
    }
  }

  public function jsonExtract($search, $data) {
    try {
      $decodedData = json_decode($data);
      
      if ($decodedData->$search) {
        $extractedString = $decodedData->$search;

        return json_decode($extractedString);
      }
    }  catch (Exception $e) {
      return '';
    }
  }
}
?>