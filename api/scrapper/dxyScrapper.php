<?php
require_once('baseScrapper.php');

// Project dependencies installed via Composer
require_once('vendor/autoload.php');
use SteelyWing\Chinese\Chinese;

class dxyScrapper extends baseScrapper {
  public function __construct() {
    $this->scrap_url = "https://ncov.dxy.cn/ncovh5/view/pneumonia";
    $this->store_folder = "scraps";
    $this->store_filename = "data.json";
  }
  
  public function postProcessing($data) {
    try {   
      // Extract data needed
      $getAreaStat = $this->jsonExtract("getAreaStat", $data);
      $getStatisticsService = $this->jsonExtract("getStatisticsService", $data);
      $getListByCountryTypeService2 = $this->jsonExtract("getListByCountryTypeService2true", $data);

      if (!empty($getAreaStat) && !empty($getStatisticsService) && !empty($getListByCountryTypeService2)) {
        // Temp hack for old service workers
        $getStatisticsService["countRemark"] = "確診 " . $getStatisticsService["confirmedCount"] . " 例，疑似 " . $getStatisticsService["suspectedCount"] . " 例，治癒 " . $getStatisticsService["curedCount"] . " 例，死亡 " . $getStatisticsService["deadCount"] . " 例";

        // Form api output
        $extracted_data = [
          "status" => 200,
          "getAreaStat" => $getAreaStat,
          "getStatisticsService" => $getStatisticsService,
          "getListByCountryTypeService2" => $getListByCountryTypeService2
        ];

        $api_output = json_encode($extracted_data);

        return $api_output;
      } else {
        return NULL;
      }
    } catch (Exception $e) {
      return NULL;
    }
  }

  public function jsonExtract($search, $data) {
    $pattern='/window.' . $search . ' = (.*?)}catch\(/m';
    
    if (preg_match($pattern, $data, $match)) {
      try {
        // Convert to Traditional Chinese
        $chinese_convertor = new Chinese();
        $result = $chinese_convertor->to(Chinese::ZH_HANT, $match[1]);

        // Localized translation for 澳洲
        $localizedResult = str_replace("澳大利亞", "澳洲", $result);
        return json_decode($localizedResult , true);
      }  catch (Exception $e) {
        // Return non processed Simplified Chinese value
        return json_decode($match[1] , true);
      }
    }
    
    return '';
  }
}
?>