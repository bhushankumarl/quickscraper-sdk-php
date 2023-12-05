<?php

namespace QuickScraper\Main;

use PHPUnit\Framework\TestCase;
use QuickScraper\Tests\Suits\Main\MockConfig;
use QuickScraper\Main\QuickScraperClass;

class ActionsFieldWithParser extends TestCase
{
	/**
	 * ----------------------------------------------------------------------
	 * Import : Use actions field with parser
	 * ----------------------------------------------------------------------
	 */
	public function testRequestWithActionsField()
	{
		$QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
		$requestUrl = 'https://www.hilton.com/en/locations/india/?WT.mc_id=zLADA0IN1MB2PSH3GGL4INTCRB5dkt6MULTIBR7en_&epid!_&ebuy!&&&&&gad_source=1&gclid=CjwKCAiAvJarBhA1EiwAGgZl0HWfZEaLc_HWhRFRxTT3gs8pwQvFZKtLPNMj3szkjCbFzlef4ox_XxoCGDYQAvD_BwE&gclsrc=aw.ds';
		try {
			$parseOptions = array(
				'URL' => 'https://www.hilton.com/en/locations/india/?WT.mc_id=zLADA0IN1MB2PSH3GGL4INTCRB5dkt6MULTIBR7en_&epid!_&ebuy!&&&&&gad_source=1&gclid=CjwKCAiAvJarBhA1EiwAGgZl0HWfZEaLc_HWhRFRxTT3gs8pwQvFZKtLPNMj3szkjCbFzlef4ox_XxoCGDYQAvD_BwE&gclsrc=aw.ds',
				'customSelectors' => array(
					array(
						'name' => 'click',
						'selectorScript' => 'input[data-testid="searchByUsePoints"]',
						'options' => null,
						'isScript' => false
					),
				),
				'keepSelection' => true,
				
			);
			$promisesGetHtml = $QuickScraperClient->getHtml($requestUrl, $parseOptions);
		} catch (\Exception $error) {
			$this->assertNotNull($error);
			$this->expectException($error);
		}
	}
}