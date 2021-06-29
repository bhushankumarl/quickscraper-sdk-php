<?php
namespace QuickScraper\Main;

use PHPUnit\Framework\TestCase;
use QuickScraper\Tests\Suits\Main\MockConfig;
use QuickScraper\Main\QuickScraperClass;
use GuzzleHttp\Exception\RequestException;

class ParseConCurrentTest extends TestCase 
{

  /** 
   * ----------------------------------------------------------------------
   * Import : Request should be failed if concurrent request count exceed 
   * ----------------------------------------------------------------------
   */
  public function testConCurrentRequest()
  {
    $QuickScraperClient = new QuickScraper(MockConfig::getAccessToken());
    $requestUrl = MockConfig::sampleRequestUrl();
  
    try {
      $promises = [];
      for ($index = 0; $index < MockConfig::getAccessToken(); $index++) {
        $promisesGetHtml = $QuickScraperClient->getHtml($requestUrl);
        array_push($promises,$promisesGetHtml);
      }
      $this->assertArrayHasKey('data', $response);
    } catch (\Exception $error) {
      $this->expectException($error);
    }
  }
}