<?php
require_once('baseScrapper.php');

class googleNewsScrapper extends baseScrapper {
  public function __construct() {
    // $this->scrap_url = "https://rss.app/feeds/6mbkDJ9rbsKORnFA.xml";
    $this->scrap_url = "https://news.google.com/rss/search?q=%E8%82%BA%E7%82%8E&hl=zh-HK&gl=HK&ceid=HK%3Azh-Hant";
    $this->store_folder = "scraps";
    $this->store_filename = "news.json";
  }
  
  public function postProcessing($data) {
    try {   
      // Convert scrapped rss to json
      $extracted_rows = $this->convertRssToJson($data);
      $api_output = json_encode($extracted_rows);

      return $api_output;
    } catch (Exception $e) {
      return NULL;
    }
  }

  public function convertRssToJson($rss) {
    $dom = new DOMDocument;
    $dom->loadHTML($rss);
    $result = [];
    $xpath = new DOMXPath($dom);

    foreach ($xpath->query('//channel/item') as $item) {
      $data = [];
      
      if($item->childNodes->length) {
        foreach($item->childNodes as $i) {
          $data[$i->nodeName] = $i->nodeValue;
        }
      }

      array_push($result, $data);
    }

    return $result;
  }
}
?>