<?php

namespace QuickScraper\Tests\Suits\Main;

class MockConfig
{
  public $SAMPLE_REQUEST_URL_1 = 'http://httpbin.org/ip';
  public $SAMPLE_REQUEST_URL_COUNTRY =  'http://ip-api.com/json';
  public $HEADER_URL = 'https://httpbin.org/headers';

    public static function sampleRequestUrl()
    {
        return 'http://httpbin.org/ip';
    }
    public static function getAccessToken()
    {
        return getenv('QS_ACCESS_TOKEN');
    }
    public static function getConcurrentCount()
    {
        return  getenv('CONCURRENT_COUNT') ? getenv('CONCURRENT_COUNT') : 50;
    }
}
