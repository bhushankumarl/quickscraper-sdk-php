<?php

namespace QuickScraper\Main;

use PHPUnit\Framework\TestCase;
use QuickScraper\Tests\Suits\Main\MockConfig;
use QuickScraper\Main\QuickScraperClass;
use GuzzleHttp\Exception\RequestException;

class QuickScraperClassTest extends TestCase
{

  /** Just check if set host */
  public function testIsThereAnySyntaxError()
  {
    $object = new QuickScraperClass('Dummy');

    $this->assertTrue(true, $object->setHost('test'));
  }

  /** Just check if accesstoken get */
  public function testAccessToken()
  {
    $this->assertTrue(true, MockConfig::getAccessToken());
  }

  /** Just check if set host is number value */
  public function testSetHost()
  {
    $object = new QuickScraperClass('Dummy');

    $this->assertFalse(false, 'Only string allow in set host : ' . $object->setHost(213));
  }


  /** Just check if set accesstoken is number value */
  public function testSetAccessTokenNumberType()
  {
    $object = new QuickScraperClass('Dummy');

    $this->assertFalse(false, 'Only string allow in set setAccessToken : ' . $object->setAccessToken(213));
  }

  /** Just check if getting html result */
  public function testGetHtml()
  {
    try {
      $object = new QuickScraperClass(MockConfig::getAccessToken());
      $response = $object->getHtml(MockConfig::sampleRequestUrl());
      $this->assertArrayHasKey('data', $response);
    } catch (\Exception $error) {
      $this->assertEquals(0, $error->getCode());
    }
  }
  /** Just check if getting html result with dummy accesstoken */
  public function testGetHtmlWrongAccessToken()
  {
    try {
      $object = new QuickScraperClass('dummy');
      $object->getHtml(MockConfig::sampleRequestUrl());
      $this->assertArrayHasKey('data', $response);
    } catch (\Exception $error) {
      $this->assertEquals(2, $error->getCode());
    }
  }
  /** Just check if getting html result with blank accesstoken */
  public function testGetHtmlBlankAccessToken()
  {
    try {
      $object = new QuickScraperClass('');
      $response = $object->getHtml(MockConfig::sampleRequestUrl());
      $arrayValue = json_decode($response);
      $this->assertArrayHasKey('data', $response);
    } catch (\Exepection $error) {
      $this->assertEquals(2, $error->getCode());
    }
  }
  /** Just check if writeFile with wrong token*/
  public function testWriteFileGetHtml()
  {
    try {
      $object = new QuickScraperClass(MockConfig::getAccessToken());
      $response = $object->writeHtmlToFile(MockConfig::sampleRequestUrl(), 'test.log');
      $this->assertArrayHasKey('data', $response);
    } catch (\Exception $error) {
      $this->assertEquals(2, $error->getCode());
    }
  }
  /** Just check if writeFile with wrong token*/
  public function testWriteFileGetHtmlWrongToken()
  {
    try {
      $object = new QuickScraperClass('dummy');
      $response = $object->writeHtmlToFile(MockConfig::sampleRequestUrl(), 'test.log');
      $this->assertArrayHasKey('data', $response);
    } catch (\Exception $error) {
      $this->assertEquals(2, $error->getCode());
    }
  }

  /** Request should Passed with POST Options */
  public function testPostGetHtml()
  {
    try {
      $object = new QuickScraperClass('dummy');
      $response = $object->post(MockConfig::sampleRequestUrl());
      $this->assertArrayHasKey('data', $response);
    } catch (\Exception $error) {
      $this->assertEquals(0, $error->getCode());
    }
  }
  /** Request should Passed with PUT Options */
  public function testPutGetHtml()
  {
    try {
      $object = new QuickScraperClass('dummy');
      $response = $object->put(MockConfig::sampleRequestUrl());
      $this->assertArrayHasKey('data', $response);
    } catch (\Exception $error) {
      $this->assertEquals(0, $error->getCode());
    }
  }
  /**
   * -------------------------------------------------------------------
   * Import : Request should be Passed with render: true 
   * -------------------------------------------------------------------
   */
  public function testWithRenderTrue()
  {
    $requestUrl = (new MockConfig)->SAMPLE_REQUEST_URL_1;
    try {
      $object = new QuickScraperClass(MockConfig::getAccessToken());
      $options = array('render' => true);
      $response = $object->getHtml($requestUrl, $options);
      $this->assertArrayHasKey('data', $response);
    } catch (\Exception $error) {
      $this->assertEquals(0, $error->getCode());
    }
  }

  /**
   *--------------------------------------------------------------------
   * Import : Request should be Passed with Custom Headers
   *--------------------------------------------------------------------
   */
  public function testCustomHeaders()
  {
    $requestUrl = (new MockConfig)->HEADER_URL;

    $QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
    try {
      $options = array(
        'keep_headers' => true,
        'headers' => array(
          'X-Custom-Header-Key-1' => 'THIS_IS_CUSTOM_HEADER_1',
          'Qs-Custom-Header-Key' => 'THIS_IS_QS_CUSTOM_HEADER'
        ),
      );
      $response = $QuickScraperClient->getHtml($requestUrl, $options);
      $this->assertArrayHasKey('data', $response);
    } catch (\Exception $error) {
      $this->assertEquals(0, $error->getCode());
    }
  }

  /**
   *---------------------------------------------------------
   * Import : Request should be Passed with Session Number
   *---------------------------------------------------------
   */

  public function testSessionNumberRequest()
  {
    $requestUrl = (new MockConfig)->SAMPLE_REQUEST_URL_1;

    $QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
    try {
      $options =  array(
        'session_number' => 'QS-' . strtotime("now")
      );
      $response = $QuickScraperClient->getHtml($requestUrl, $options);
      $this->assertArrayHasKey('data', $response);
    } catch (\Exception $error) {
      $this->assertEquals(0, $error->getCode());
    }
  }
  
  /**
   *---------------------------------------------------------
   * Import : Request should be Passed with IN Location
   *---------------------------------------------------------
   */
  public function testINLocation(){
    $requestUrl = (new MockConfig)->SAMPLE_REQUEST_URL_COUNTRY;
    $QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
     try {
       $options = array(
         'country_code' => 'IN'
       );
       $response = $QuickScraperClient->getHtml($requestUrl, $options);
 
     } catch (\Exception $error) {
       $this->assertEquals(0, $error->getCode());
     }
   }
 
   /**
    *---------------------------------------------------------
    * Import : Request should be Passed with Premium Proxy
    *---------------------------------------------------------
    */
   public function testPremiumProxy(){
    $requestUrl = (new MockConfig)->SAMPLE_REQUEST_URL_1;
    $QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
     try {
       $options = array(
         'premium' => true
       );
       $response = $QuickScraperClient->getHtml($requestUrl, $options);
 
     } catch (\Exception $error) {
       $this->assertEquals(0, $error->getCode());
     }
   }
 
   /**
    *---------------------------------------------------------
    * Import : Request should be Passed with POST Options
    *---------------------------------------------------------
    */
   public function testPOSTOptions(){
    $requestUrl = (new MockConfig)->SAMPLE_REQUEST_URL_COUNTRY;
    $QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
     try {
       $options = array(
         'premium' => true
       );
       $response = $QuickScraperClient->getHtml($requestUrl, $options);
 
     } catch (\Exception $error) {
       $this->assertEquals(0, $error->getCode());
     }
   }
 
   /**
    *---------------------------------------------------------
    * Import : Request should be Passed with PUT Options
    *---------------------------------------------------------
    */
   public function testPUTOptions(){
    $requestUrl = (new MockConfig)->SAMPLE_REQUEST_URL_1;
    $QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
     try {
       $options = array(
         'premium' => true
       );
       $response = $QuickScraperClient->getHtml($requestUrl, $options);
 
     } catch (\Exception $error) {
       $this->assertEquals(0, $error->getCode());
     }
   }
}
