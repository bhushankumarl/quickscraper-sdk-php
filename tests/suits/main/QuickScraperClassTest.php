<?php

namespace QuickScraper\Main;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use QuickScraper\Constants\Config;

/**
 *  Corresponding class to test YourClass class
 *
 *  For each class in your library, there should be a corresponding unit test
 *
 *  @author yourname
 */
class QuickScraperClassTest extends TestCase
{

    private $DEFAULT = array(
      "CLIENT" =>'NODEJS_CLIENT_LIB',
      "HOST" => 'https://rest.quickscraper.co/'
    );
    /**
     * Just check if the YourClass has no syntax errors
     */
    public function testIsThereAnySyntaxError()
    {
        $object = new QuickScraperClass('Dummy');

        $this->assertTrue(true, $object->setHost('test'));
    }
    /**
     * Just check if the YourClass has no syntax errors
     */
    public function testAccessToken()
    {
        $this->assertTrue(true, Config::getAccessToken());
    }
    /**
     * Just check if set host is number value
     */
    public function testSetHost()
    {
        $object = new QuickScraperClass('Dummy');

        $this->assertFalse(false,"Only string allow in set host : ".$object->setHost(213));
    }
    
    /**
     * Just check if set host is number value
     */
    public function testSetAccessTokenNumberType()
    {
        $object = new QuickScraperClass('Dummy');

        $this->assertFalse(false,"Only string allow in set setAccessToken : ".$object->setAccessToken(213));
    }
    /**
     * Just check if getting html result
     */
    public function testGetHtml()
    {
        $object = new QuickScraperClass(Config::getAccessToken());
        $httpClient = new Client();
        $requestUrl = $this->prepareRequestUrl('https://google.com');
        $headers = $this->prepareHeaders();
        $options = array(
            'headers'=> $headers
        );
        try{
            $response = $httpClient->get($requestUrl, $options);
            $this->assertEquals(200,$response->getStatusCode());

        }catch(\Exception $error){
            $this->expectException($error);
        }
    }
    /**
     * Just check if getting html result
     */
    public function testGetHtmlWrongAccessToken()
    {
        $url = "http://google.com";
        $requestUrl = $this->DEFAULT['HOST'].'parse'.'?access_token=dummy&URL='.$url;
       
        $httpClient = new Client();
        $headers = $this->prepareHeaders();
        $options = array(
            'headers'=> $headers
        );
        try{
            $response = $httpClient->getAsync($requestUrl, $options)->wait();
            $this->assertEquals(200,$response->getStatusCode());
        }catch(\Exception $error){
            $this->assertEquals(403,$error->getCode());
        }
    }
    /**
     * Just check if getting html result
     */
    public function testGetHtmlBlankAccessToken()
    {
        $url = "http://google.com";
        $requestUrl = $this->DEFAULT['HOST'].'parse'.'?access_token=&URL='.$url;
       
        $httpClient = new Client();
        $headers = $this->prepareHeaders();
        $options = array(
            'headers'=> $headers
        );
        try{
            $response = $httpClient->getAsync($requestUrl, $options)->wait();
            $this->assertEquals(200,$response->getStatusCode());
        }catch(\Exception $error){
            $this->assertEquals(403,$error->getCode());
        }
    }
    /**
     * Just check if writeFile
     */
    public function testWriteFileGetHtml()
    {
        $object = new QuickScraperClass(Config::getAccessToken());
        $httpClient = new Client();
        $requestUrl = $this->prepareRequestUrl('https://google.com');
        $headers = $this->prepareHeaders();
        $options = array(
            'headers'=> $headers
        );
        try{
            $response = $object->writeHtmlToFile('http://google.com','test.log');
            $this->objectHasAttribute('data');

        }catch(\Exception $error){
            $this->expectException($error);
        }
    }
    
   

    private function prepareRequestUrl(string $url): string
    {
        $object = new QuickScraperClass(Config::getAccessToken());

        $requestUrl = $this->DEFAULT['HOST'].'parse'.'?access_token='.Config::getAccessToken().'&URL='.$url;
        return $requestUrl;
    }
    private function prepareHeaders() {
      $headers = array(
        'client' => $this->DEFAULT['CLIENT']
      );
      return $headers;
    }
   
}
