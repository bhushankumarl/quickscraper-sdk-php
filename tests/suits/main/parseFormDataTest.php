<?php

namespace QuickScraper\Main;

use PHPUnit\Framework\TestCase;
use QuickScraper\Tests\Suits\Main\MockConfig;
use QuickScraper\Main\QuickScraperClass;

class ParserRequestWithFormData extends TestCase
{
	/**
	 * ----------------------------------------------------------------------
	 * Import : Pass form data
	 * ----------------------------------------------------------------------
	 */
	public function testConCurrentRequest()
	{
		$QuickScraperClient = new QuickScraperClass(MockConfig::getAccessToken());
		$requestUrl = 'https://www.amazon.com';

		try {
			$parseOptions = array(
				'URL' => 'https://www.amazon.com',
				'country_code' => 'any',
				'customSelectors' => array(
					array(
						'name' => 'waitForSelector',
						'selectorScript' => '#search',
						'options' => null,
						'isScript' => false
					),
				),
				'keepSelection' => true,
				'formData' => array(
					'formSelector' => '#nav-search-bar-form',
					'submitButtonSelector' => '#nav-search-submit-button',
					'formSelectorScript' => '',
					'submitButtonSelectorScript' => '',
					'formFields' => array(
						array(
							'value' => 'Laptop',
							'selectorScript' => '#twotabsearchtextbox',
							'isScript' => false
						)
					)
				),
				'keepFormdataSelection' => true,
				'format' => 'html',
				'submitType' => 'local',
				'isScroll' => true
			);
			$promisesGetHtml = $QuickScraperClient->getHtml($requestUrl, $parseOptions);
			return $promisesGetHtml;
		} catch (\Exception $error) {
			$this->assertNotNull($error);
			$this->expectException($error);
		}
	}
}