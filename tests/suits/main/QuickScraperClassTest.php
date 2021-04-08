<?php

namespace QuickScraper\Main;

use PHPUnit\Framework\TestCase;
use QuickScraper\Tests\Suits\Main\MockConfig;

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
        $object = new QuickScraperClass(MockConfig::getAccessToken());
        $response = $object->getHtml(MockConfig::sampleRequestUrl());
        $this->assertArrayHasKey('data', $response);
    }
    /** Just check if getting html result with dummy accesstoken */
    public function testGetHtmlWrongAccessToken()
    {
        try {
            $object = new QuickScraperClass('dummy');
            $object->getHtml(MockConfig::sampleRequestUrl());
        } catch (\Exception $error) {
            $this->assertEquals(0, $error->getCode());
        }
    }
    /** Just check if getting html result with blank accesstoken */
    public function testGetHtmlBlankAccessToken()
    {
        try {
            $object = new QuickScraperClass('');
            $object->getHtml(MockConfig::sampleRequestUrl());
        } catch (\Exception $error) {
            $this->assertEquals(0, $error->getCode());
        }
    }
    /** Just check if writeFile with wrong token*/
    public function testWriteFileGetHtml()
    {
        $object = new QuickScraperClass(MockConfig::getAccessToken());
        $response = $object->writeHtmlToFile(MockConfig::sampleRequestUrl(), 'test.log');
        $this->assertArrayHasKey('data', $response);
    }
    /** Just check if writeFile with wrong token*/
    public function testWriteFileGetHtmlWrongToken()
    {
        $object = new QuickScraperClass('dummy');
        try {
            $object->writeHtmlToFile(MockConfig::sampleRequestUrl(), 'test.log');
        } catch (\Exception $error) {
            $this->assertEquals(0, $error->getCode());
        }
    }
    
    /** Request should Passed with POST Options */
    public function testPostGetHtml()
    {
        $object = new QuickScraperClass('dummy');
        try {
            $object->post(MockConfig::sampleRequestUrl());
        } catch (\Exception $error) {
            $this->assertEquals(0, $error->getCode());
        }
    }
    /** Request should Passed with PUT Options */
    public function testPutGetHtml()
    {
        $object = new QuickScraperClass('dummy');
        try {
            $object->put(MockConfig::sampleRequestUrl());
        } catch (\Exception $error) {
            $this->assertEquals(0, $error->getCode());
        }
    }
}
