<?php

namespace QuickScraper\Constants;

class Config{

  protected $apiUrl;

  function __construct(){
    $this->apiUrl = 'https://rest.quickscraper.co/';
  }
  
  public function getApiUrl(){
    return $this->apiUrl;
  }

}
?>