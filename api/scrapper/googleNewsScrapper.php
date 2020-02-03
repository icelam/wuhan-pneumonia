<?php
require_once('baseScrapper.php');

class googleNewsScrapper extends baseScrapper {
  public function __construct() {
    $this->scrap_url = "https://rss.app/feeds/6mbkDJ9rbsKORnFA.xml";
    // $this->scrap_url = "https://news.google.com/rss/search?q=%E8%82%BA%E7%82%8E&hl=zh-HK&gl=HK&ceid=HK%3Azh-Hant";
    $this->store_folder = "scraps";
    $this->store_filename = "news.json";
  }
  
  public function postProcessing($data) {
    try {   
      // Convert scrapped rss to json
      // TODO: non-hardcoded handling
      $removedNS = str_replace("media:content", "mediaContent", $data);
      $removedNS = str_replace("dc:creator", "creator", $removedNS);

      $api_output = $this->convertRssToJson($removedNS);

      return $api_output;
    } catch (Exception $e) {
      var_dump($e->getMessage());
      return NULL;
    }
  }

  private function convertRssToJson($rss) {
    $xml = simplexml_load_string($rss,"SimpleXMLElement", LIBXML_NOCDATA);
    
    // Convert publish time to timestamp
    foreach ($xml->channel->item as $item) {
      if (isset($item->pubDate)) {
        $item->timestamp = strtotime($item->pubDate);
      }

      // Strip tags in description
      if (isset($item->description)) {
        $item->description = strip_tags($item->description);
      }
    }

    $result = json_encode($xml);

    return $result;
  }
}
?>