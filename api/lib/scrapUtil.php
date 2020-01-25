<?php
// Project dependencies installed via Composer
require_once('vendor/autoload.php');
use SteelyWing\Chinese\Chinese;

class scrapUtil {
  public function __construct() {
    $this->scrap_url = "https://3g.dxy.cn/newh5/view/pneumonia";
    $this->store_folder = 'scraps';
    $this->store_filename = 'data.json';
  }
  
  public function scrapContent() {
    try {   
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->scrap_url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $server_output = curl_exec ($ch);
      $scrap_error = curl_error($ch);
      $scrap_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      $scrap_length = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
      
      curl_close ($ch);

      // Error handling
      if ($scrap_error || $scrap_status_code !== 200) {
        throw new Exception($scrap_error);
      }

      // Extract data needed
      $getAreaStat = $this->jsonExtract("getAreaStat", $server_output);
      $getStatisticsService = $this->jsonExtract("getStatisticsService", $server_output);
      $getTimelineService = $this->jsonExtract("getTimelineService", $server_output);
      $getListByCountryTypeService1 = $this->jsonExtract("getListByCountryTypeService1", $server_output);

      if (!empty($getAreaStat) && !empty($getStatisticsService) && !empty($getStatisticsService) && !empty($getListByCountryTypeService1)) {
        // Form api output
        $extracted_data = [
          "status" => $scrap_status_code,
          "getAreaStat" => $getAreaStat,
          "getStatisticsService" => $getStatisticsService,
          "getTimelineService" => $getTimelineService,
          "getListByCountryTypeService1" => $getListByCountryTypeService1,
        ];

        $api_output = json_encode($extracted_data);

        // Backup scrap data for future use
        if(!is_dir($this->store_folder)){
          if (!mkdir($this->store_folder, 0777, true)) {
            // Failed to create folder, skip saving
            return $api_output;
          }
        }

        $fp = fopen($this->store_folder . "/" . $this->store_filename, "w");
        fwrite($fp, $api_output);
        fclose($fp);

        return $api_output;
      } else {
        throw new Exception('Scrap data is empty.');
      }
    } catch (Exception $e) {
      // Show backup data
      if(file_exists($this->store_folder . "/" . $this->store_filename)) {
        $backup_data = file_get_contents($this->store_folder . "/" . $this->store_filename);
        return $backup_data;
      }
        
      return '{"status": 500, "reason": "' . $e . '"}';
    }
  }

  public function jsonExtract($search, $data) {
    $pattern='/window.' . $search . ' = (.*?)}catch\(/m';
    
    if (preg_match($pattern, $data, $match)) {
      try {
        // Convert to Traditional Chinese
        $chinese_convertor = new Chinese();
        $result = $chinese_convertor->to(Chinese::ZH_HANT, $match[1]);
        return json_decode($result , true);
      }  catch (Exception $e) {
        // Return non processed Simplified Chinese value
        return json_decode($match[1] , true);
      }
    }
    
    return '';
  }
}
?>