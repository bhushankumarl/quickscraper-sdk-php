<?php 

namespace QuickScraper\Main;

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
    /**
     * Just check if the YourClass has no syntax errors
     */
    public function testIsThereAnySyntaxError()
    {
        $object = new QuickScraperClass('');

        $this->assertTrue(true, $object->setHost('test'));
    }

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

   
    public function testSetAccessToken()
    {
        $object = new QuickScraperClass('dummy');

        $this->assertFalse(false, $object->setAccessToken('dummy'));
    }
   
    public function testWriteFile()
    {
        $object = new QuickScraperClass('ucVFHzCdkzKLgtDhTh1RJ9EWx');
        $this->objectHasAttribute('data', $object->getHtml('http://google.com'));
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