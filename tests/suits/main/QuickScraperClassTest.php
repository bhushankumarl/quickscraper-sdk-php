<?php

namespace QuickScraper\Main;

use PHPUnit\Framework\TestCase;
use QuickScraper\Tests\Suits\Main\MockConfig;
use QuickScraper\Main\QuickScraperClass;

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
      $responseArray = json_decode($response);
      $this->assertObjectNotHasAttribute('message', $responseArray);
      $this->assertObjectHasAttribute('data', $responseArray);
      $this->assertNotNull($responseArray);
    } catch (\Exception $error) {
      $this->expectException($error->getMessage());
    }
  }
  /** Just check if getting html result with dummy accesstoken */
  public function testGetHtmlWrongAccessToken()
  {
    try {
      $object = new QuickScraperClass('dummy');
      $response = $object->getHtml(MockConfig::sampleRequestUrl());
      $responseArray = json_decode($response);
      $this->assertObjectNotHasAttribute('data', $responseArray);
      $this->assertObjectHasAttribute('message', $responseArray);
      $this->assertNotNull($responseArray);
    } catch (\Exception  $error) {
      $this->assertNotNull($error);
      $this->expectException($error->getMessage());
    }
  }
  /** Just check if getting html result with blank accesstoken */
  public function testGetHtmlBlankAccessToken()
  {
   
    try {
      $object = new QuickScraperClass('');
      $response = $object->getHtml(MockConfig::sampleRequestUrl());
      $responseArray = json_decode($response);
      $this->assertObjectHasAttribute('message', $responseArray);
      $this->assertObjectNotHasAttribute('data', $responseArray);
      $this->assertNotNull($responseArray);
    } catch (\Exception  $error) {
      $this->assertNotNull($error);
      $this->expectException($error->getMessage());
    }
  }
  /** Just check if writeFile with wrong token*/
  public function testWriteFileGetHtml()
  {
    try {
      $object = new QuickScraperClass(MockConfig::getAccessToken());
      $response = $object->writeHtmlToFile(MockConfig::sampleRequestUrl(), 'test.log');
      $responseArray = json_decode($response);
      $this->assertObjectHasAttribute('data', $responseArray);
      $this->assertObjectNotHasAttribute('message', $responseArray);
      $this->assertNotNull($responseArray);
    } catch (\Exception  $error) {
      $this->assertNotNull($error);
      $this->expectException($error->getMessage());
    }
  }
  /** Just check if writeFile with wrong token*/
  public function testWriteFileGetHtmlWrongToken()
  {
    try {
      $object = new QuickScraperClass('dummy');
      $response = $object->writeHtmlToFile(MockConfig::sampleRequestUrl(), 'test.log');
      $responseArray = json_decode($response);
      $this->assertObjectHasAttribute('message', $responseArray);
      $this->assertObjectNotHasAttribute('data', $responseArray);
      $this->assertNotNull($responseArray);
    } catch (\Exception  $error) {
      $this->assertNotNull($error);
      $this->expectException($error->getMessage());
    }
  }

  /** Request should Passed with POST Options */
  // public function testPostGetHtml()
  // {
  //   try {
  //     $object = new QuickScraperClass('dummy');
  //     $response = $object->post(MockConfig::sampleRequestUrl());
  //     $responseArray = json_decode($response);
  //     $this->assertObjectHasAttribute('message', $responseArray);
  //     $this->assertObjectNotHasAttribute('data', $responseArray);
  //      $this->assertNotNull($responseArray);
  //   } catch (\Exception  $error) {
  //     $this->assertNotNull($error);
  //     $this->expectException($error->getMessage());
  //   }
  // }
  /** Request should Passed with PUT Options */
  // public function testPutGetHtml()
  // {
  //   try {
  //     $object = new QuickScraperClass('dummy');
  //     $response = $object->put(MockConfig::sampleRequestUrl());
  //     $responseArray = json_decode($response);
  //     $this->assertObjectHasAttribute('message', $responseArray);
  //     $this->assertObjectNotHasAttribute('data', $responseArray);
  //      $this->assertNotNull($responseArray);
  //   } catch (\Exception  $error) {
  //     $this->assertNotNull($error);
  //     $this->expectException($error->getMessage());
  //   }
  // }
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
      $responseArray = json_decode($response);
      $this->assertObjectNotHasAttribute('message', $responseArray);
      $this->assertObjectHasAttribute('data', $responseArray);
      $this->assertNotNull($responseArray);
    } catch (\Exception  $error) {
      $this->assertNotNull($error);
      $this->expectException($error->getMessage());
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
      $responseArray = json_decode($response);
      $this->assertObjectNotHasAttribute('message', $responseArray);
      $this->assertObjectHasAttribute('data', $responseArray);
      $this->assertNotNull($responseArray);
    } catch (\Exception  $error) {
      $this->assertNotNull($error);
      $this->expectException($error->getMessage());
    }
  }

  /**
   *---------------------------------------------------------
   * Import : Request should be Passed with Session Number
   *---------------------------------------------------------
   */

  // public function testSessionNumberRequest()
  // {
  //   $requestUrl = (new MockConfig)->SAMPLE_REQUEST_URL_1;

  //   $QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
  //   try {
  //     $options =  array(
  //       'session_number' => 'QS-' . strtotime("now")
  //     );
  //     $response = $QuickScraperClient->getHtml($requestUrl, $options);
  //     $responseArray = json_decode($response);
  //     $this->assertObjectNotHasAttribute('message', $responseArray);
  //     $this->assertObjectHasAttribute('data', $responseArray);
  //     $this->assertNotNull($responseArray);
  //   } catch (\Exception  $error) {
  //     $this->assertNotNull($error);
  //     $this->expectException($error->getMessage());
  //   }
  // }

  /**
   *---------------------------------------------------------
   * Import : Request should be Passed with US Location
   *---------------------------------------------------------
   */
  public function testUSLocation()
  {
    $requestUrl = (new MockConfig)->SAMPLE_REQUEST_URL_COUNTRY;
    $QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
    try {
      $options = array(
        'country_code' => 'US'
      );
      $response = $QuickScraperClient->getHtml($requestUrl, $options);
      $responseArray = json_decode($response);
      $this->assertObjectNotHasAttribute('message', $responseArray);
      $this->assertObjectHasAttribute('data', $responseArray);
      $this->assertNotNull($responseArray);
  } catch (\Exception  $error) {
    $this->assertNotNull($error);
      $this->expectException($error->getMessage());
    }
  }

  /**
   *---------------------------------------------------------
   * Import : Request should be Passed with Premium Proxy
   *---------------------------------------------------------
   */
  public function testPremiumProxy()
  {
    $requestUrl = (new MockConfig)->SAMPLE_REQUEST_URL_1;
    $QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
    try {
      $options = array(
        'premium' => true
      );
      $response = $QuickScraperClient->getHtml($requestUrl, $options);
      $responseArray = json_decode($response);
      $this->assertObjectNotHasAttribute('message', $responseArray);
      $this->assertObjectHasAttribute('data', $responseArray);
      $this->assertNotNull($responseArray);
    } catch (\Exception  $error) {
      $this->assertNotNull($error);
      $this->expectException($error->getMessage());
    }
  }
  /**
	 * ----------------------------------------------------------------------
	 * Import : Use actions field with parser
	 * ----------------------------------------------------------------------
	 */
  public function testActionsWithParser()
  {
    $requestUrl = (new MockConfig)->HEADER_URL;

    $QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
    try {
      $options = array(
        'keepSelection' => true,
        'customSelectors' => array(
          'name' => 'click',
          'selectorScript' => 'input[data-testid="searchByUsePoints"]',
          'options' => null,
          'isScript' => false
        ),
      );
      $response = $QuickScraperClient->getHtml($requestUrl, $options);
      $responseArray = json_decode($response);
      $this->assertObjectNotHasAttribute('message', $responseArray);
      $this->assertObjectHasAttribute('data', $responseArray);
      $this->assertNotNull($responseArray);
    } catch (\Exception  $error) {
      $this->assertNotNull($error);
      $this->expectException($error->getMessage());
    }
  }
  /**
   *---------------------------------------------------------
   * Import : Request should be Passed with POST Options
   *---------------------------------------------------------
   */
  // public function testPOSTOptions()
  // {
  //   $requestUrl = (new MockConfig)->SAMPLE_REQUEST_URL_COUNTRY;
  //   $QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
  //   try {
  //     $options = array(
  //       'premium' => true
  //     );
  //     $response = $QuickScraperClient->getHtml($requestUrl, $options);
  //     $responseArray = json_decode($response);
  //     $this->assertObjectNotHasAttribute('message', $responseArray);
  //     $this->assertObjectHasAttribute('data', $responseArray);
  //     $this->assertNotNull($responseArray);
  //   } catch (\Exception  $error) {
  //     $this->assertNotNull($error);
  //     $this->expectException($error->getMessage());
  //   }
  // }

  /**
   *---------------------------------------------------------
   * Import : Request should be Passed with PUT Options
   *---------------------------------------------------------
   */
  // public function testPUTOptions()
  // {
  //   $requestUrl = (new MockConfig)->SAMPLE_REQUEST_URL_1;
  //   $QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
  //   try {
  //     $options = array(
  //       'premium' => true
  //     );
  //     $response = $QuickScraperClient->getHtml($requestUrl, $options);
  //     $responseArray = json_decode($response);
  //     $this->assertObjectNotHasAttribute('message', $responseArray);
  //     $this->assertObjectHasAttribute('data', $responseArray);
  //     $this->assertNotNull($responseArray);
  //   } catch (\Exception  $error) {
  //     $this->assertNotNull($error);
  //     $this->expectException($error->getMessage());
  //   }
  // }
}
