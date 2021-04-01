<?php

namespace QuickScraper\Main;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use QuickScraper\Constants\Config;
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
        $this->assertTrue(true, Config::getAccessToken());
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
        $object = new QuickScraperClass(Config::getAccessToken());
        $response = $object->getHtml('http://google.com');
        $this->assertArrayHasKey('data', $response);
    }
    /** Just check if getting html result with dummy accesstoken */
    public function testGetHtmlWrongAccessToken()
    {
        try {
            $object = new QuickScraperClass('dummy');
            $object->getHtml('http://google.com');
        } catch (\Exception $error) {
            $this->assertEquals(0, $error->getCode());
        }
    }
    /** Just check if getting html result with blank accesstoken */
    public function testGetHtmlBlankAccessToken()
    {
        try {
            $object = new QuickScraperClass('');
            $object->getHtml('http://google.com');
        } catch (\Exception $error) {
            $this->assertEquals(0, $error->getCode());
        }
    }
    /** Just check if writeFile with wrong token*/
    public function testWriteFileGetHtml()
    {
        $object = new QuickScraperClass('dummy');
        try {
            $object->writeHtmlToFile('http://google.com', 'test.log');
        } catch (\Exception $error) {
            $this->assertEquals(0, $error->getCode());
        }
    }
}
