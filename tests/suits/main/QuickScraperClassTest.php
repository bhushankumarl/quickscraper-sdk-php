<?php

namespace QuickScraper\Main;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

/**
 *  Corresponding class to test YourClass class
 *
 *  For each class in your library, there should be a corresponding unit test
 *
 *  @author yourname
 */
class QuickScraperClassTest extends TestCase
{
    private $http;

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
        $this->assertTrue(true, getenv('QS_ACCESS_TOKEN'));
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
     * @expectedException InvalidArgumentException

     */
    // public function testGetHtmlAllowOnlyStringParameter()
    // {
    //     var_dump(getenv('QS_ACCESS_TOKEN'));
    //     $object = new QuickScraperClass(getenv('QS_ACCESS_TOKEN'));
    //     $httpClient = new Client();
    //     $requestUrl = $this->prepareRequestUrl('https://google.com');
    //     $headers = $this->prepareHeaders();
    //     $options = array(
    //         'headers'=> $headers
    //     );
    //     $response = $httpClient->get($requestUrl, $options);

    //     $this->expectException(200,$response->getStatusCode());
    //     $this->expectException(200,$response->getStatusCode());
    // }
    
    /**
     * Test the only existing method of the class
     *
     * @dataProvider getNamesAndGreetings
     *
     * @param $name
     * @param $expected
     */
    public function testSayHello($expected, $name)
    {
        $object = new QuickScraperClass('dummy');

        $this->assertTrue($expected, $object->sayHello($name));
    }


    private function prepareRequestUrl(string $url): string
    {
        $object = new QuickScraperClass(getenv('QS_ACCESS_TOKEN'));

        $requestUrl = $this->DEFAULT['HOST'].'parse'.'?access_token='.getenv('QS_ACCESS_TOKEN').'&URL='.$url;
        return $requestUrl;
    }
    private function prepareHeaders() {
      $headers = array(
        'client' => $this->DEFAULT['CLIENT']
      );
      return $headers;
    }
    /**
     * Data for sayHello
     *
     * @return array
     */
    public function getNamesAndGreetings(): array
    {
        return [
            [true, "Hello World!"],
            [true, "Hello World!"]
        ];
    }
}
