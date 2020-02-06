<?php
require_once('baseScrapper.php');

class googleNewsScrapper extends baseScrapper {
  public function __construct() {
    // $this->scrap_url = "https://rss.app/feeds/6mbkDJ9rbsKORnFA.xml";
    $this->scrap_url = "https://news.google.com/rss/topics/CAAqLAgKIiZDQkFTRmdvTkwyY3ZNVEZtY2pFMWRERTFhQklGZW1ndFNFc29BQVAB?hl=zh-HK&gl=HK&ceid=HK:zh-Hant";
    $this->store_folder = "scraps";
    $this->store_filename = "news.json";
  }
  
  public function postProcessing($data) {
    try { 
      $api_output = $this->convertRssToJson($data);

      return $api_output;
    } catch (Exception $e) {
      var_dump($e->getMessage());
      return NULL;
    }
  }

  // rss.app have a low chance to return invalid characters:
  // Reference: https://stackoverflow.com/a/3466049
  private function convertRssToJson($rss) {
    $rssStriped = $this->stripInvalidXml($rss);
    $xml = simplexml_load_string($rssStriped,"SimpleXMLElement", LIBXML_NOCDATA);
    
    // Convert publish time to timestamp
    foreach ($xml->channel->item as $item) {
      if (isset($item->pubDate)) {
        $item->timestamp = strtotime($item->pubDate);
      }
    }

    $result = json_encode($xml);

    return $result;
  }

  private function stripInvalidXml($value) {
    $ret = "";
    $current;
    if (empty($value)) {
        return $ret;
    }

    $length = strlen($value);

    for ($i=0; $i < $length; $i++) {
      $current = ord($value{$i});
      if (($current == 0x9) ||
        ($current == 0xA) ||
        ($current == 0xD) ||
        (($current >= 0x20) && ($current <= 0xD7FF)) ||
        (($current >= 0xE000) && ($current <= 0xFFFD)) ||
        (($current >= 0x10000) && ($current <= 0x10FFFF))) {
        $ret .= chr($current);
      } else {
          $ret .= " ";
      }
    }
    return $ret;
  }
}
?>