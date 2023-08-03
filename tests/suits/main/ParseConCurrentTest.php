<?php

namespace QuickScraper\Main;

use PHPUnit\Framework\TestCase;
use QuickScraper\Tests\Suits\Main\MockConfig;
use QuickScraper\Main\QuickScraperClass;

class ParseConCurrentTest extends TestCase
{
	/**
	 * ----------------------------------------------------------------------
	 * Import : Request should be failed if concurrent request count exceed
	 * ----------------------------------------------------------------------
	 */
	public function testConCurrentRequest()
	{
		$QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
		$requestUrl = MockConfig::sampleRequestUrl();

		try {
			$promises = [];
			for ($index = 0; $index < MockConfig::getConcurrentCount(); $index++) {
				$promisesGetHtml = $QuickScraperClient->getHtml($requestUrl);
				$responseArray = json_decode($promisesGetHtml);
				array_push($promises, $responseArray);
				$this->assertObjectHasAttribute('data', $responseArray);
				$this->assertObjectNotHasAttribute('message', $responseArray);
				$this->assertNotNull($responseArray);
			}
			$this->assertNotEmpty($promises);
		} catch (\Exception $error) {
			$this->assertNotNull($error);
			$this->expectException($error);
		}
	}
}