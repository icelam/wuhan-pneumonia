<?php
require_once('baseScrapper.php');

class pharmacyScrapper extends baseScrapper {
  public function __construct() {
    $this->scrap_url = "https://docs.google.com/spreadsheets/d/1x4gHNkS5cfKO8qi-MIp7EiNZP2m5zhK-yv9XSseZqmA/gviz/tq?tqx=out:html&tq&gid=225766462";
    $this->store_folder = "scraps";
    $this->store_filename = "pharmacy.json";
  }
  
  public function postProcessing($data) {
    try {   
      // Convert scrapped table to json
      $extractedRows = $this->convertTableToJson($data);
      $api_output = json_encode($extractedRows);

      return $api_output;
    } catch (Exception $e) {
      return NULL;
    }
  }

  public function convertTableToJson($html) {
    $dom = new DOMDocument;
    $dom->loadHTML($html);
    $result = [];
    $xpath = new DOMXPath($dom);
    foreach ($xpath->query('//table/tr') as $tr) {
      $row = [];
      foreach ($xpath->query("td", $tr) as $key=>$td) {
        $row[$key] = trim($td->textContent);
      }

      array_push($result, $row);
    }

    return $result;
  }
}
?>