<?php
class baseScrapper {
  public function __construct($target_url, $target_file_name) {
    $this->scrap_url = $target_url;
    $this->store_folder = "scraps";
    $this->store_filename = $target_file_name;
  }
  
  public function scrapContent() {
    try {   
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $this->scrap_url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

      $server_output = curl_exec ($ch);
      $scrap_error = curl_error($ch);
      $scrap_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
      
      curl_close ($ch);

      // Error handling
      if ($scrap_error || $scrap_status_code !== 200) {
        throw new Exception($scrap_error);
      }

      $api_output = $this->postProcessing($server_output);

      if (!empty($api_output) && !is_null($api_output) && $api_output !== 'null') {
        // Backup scrap data for future use
        if(!is_dir($this->store_folder)){
          if (!mkdir($this->store_folder, 0755, true)) {
            // Failed to create folder, skip saving
            return $api_output;
          }
        }

        $fp = fopen($this->store_folder . "/" . $this->store_filename, "w");
        
        // Lock file for writing
        if (flock($fp, LOCK_EX)) {  
          ftruncate($fp, 0);
          fwrite($fp, $api_output);
          fflush($fp);
          flock($fp, LOCK_UN);
        } 
        
        fclose($fp);

        return $api_output;
      }
      
      throw new Exception('Scrap data is empty or has unknown error.');
    } catch (Exception $e) {
      // Show backup data
      if(file_exists($this->store_folder . "/" . $this->store_filename)) {
        $backup_data = file_get_contents($this->store_folder . "/" . $this->store_filename);
        return $backup_data;
      }
      
      http_response_code(500);
      return '{"status": 500, "reason": "' . $e->getMessage() . '"}';
    }
  }

  public function postProcessing($data) {
    return $data;
  }
}
?>