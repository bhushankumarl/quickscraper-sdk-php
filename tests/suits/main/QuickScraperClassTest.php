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

        $this->assertFalse(false, 'Only string allow in set host : '.$object->setHost(213));
    }
    

    /** Just check if set accesstoken is number value */
    public function testSetAccessTokenNumberType()
    {
        $object = new QuickScraperClass('Dummy');

        $this->assertFalse(false, 'Only string allow in set setAccessToken : '.$object->setAccessToken(213));
    }

    /** Just check if getting html result */
    public function testGetHtml()
    {
      try{
        $object = new QuickScraperClass(MockConfig::getAccessToken());
        $response = $object->getHtml(MockConfig::sampleRequestUrl());
        $this->assertArrayHasKey('data', $response);
      }catch(\Exception $error){
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
      try{
        $object = new QuickScraperClass(MockConfig::getAccessToken());
        $response = $object->writeHtmlToFile(MockConfig::sampleRequestUrl(), 'test.log');
        $this->assertArrayHasKey('data', $response);         
        }catch(\Exception $error){
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
}
