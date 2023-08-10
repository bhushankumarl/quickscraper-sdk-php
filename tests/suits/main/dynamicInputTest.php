<?php

namespace QuickScraper\Main;

use PHPUnit\Framework\TestCase;
use QuickScraper\Tests\Suits\Main\MockConfig;
use QuickScraper\Main\QuickScraperClass;

class DynamicInputsWithParser extends TestCase
{
	/**
	 * ----------------------------------------------------------------------
	 * Import : Use Dynamic input with parser
	 * ----------------------------------------------------------------------
	 */
	public function testConCurrentRequest()
	{
		$QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
		$requestUrl = 'https://app.libraleads.com/#/search';

		try {
			$parseOptions = array(
				'URL' => 'https://app.libraleads.com/#/search',
				'country_code' => 'any',
				'parserSubscriptionId' => 'YOUR_PARSER_SUBSCRIPTION_ID',
				'dynamicInputs' => array(
					array(
						'label' => 'username',
						'value' => 'username'
					),
					array(
						'label' => 'password',
						'value' => 'password'
					)
				),
				'format' => 'html',
				'submitType' => 'local'
			);
			$promisesGetHtml = $QuickScraperClient->getHtml($requestUrl, $parseOptions);
			return $promisesGetHtml;
		} catch (\Exception $error) {
			$this->assertNotNull($error);
			$this->expectException($error);
		}
	}
}