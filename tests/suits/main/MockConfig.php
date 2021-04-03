<?php

namespace QuickScraper\Tests\Suits\Main;

class MockConfig
{
    public static function sampleRequestUrl()
    {
        return 'http://httpbin.org/ip';
    }
    public static function getAccessToken()
    {
        return getenv('QS_ACCESS_TOKEN');
    }
}
