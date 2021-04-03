<?php

namespace QuickScraper\Constants;

class Config{

  protected $BASE_URL;

  function __construct(){
    $this->BASE_URL = 'https://rest.quickscraper.co/';
  }
  
  public function getBaseUrl(){
    return $this->BASE_URL;
  }
  public static function getAccessToken(){
    return getenv('QS_ACCESS_TOKEN');
  }
  

}
?>