<?php
require_once('baseScrapper.php');

class haGovScrapper extends baseScrapper {
  public function __construct() {
    $this->scrap_url = "https://www.ha.org.hk/opendata/aed/aedwtdata-tc.json";
    $this->store_folder = "scraps";
    $this->store_filename = "ha.json";
  }
}
?>