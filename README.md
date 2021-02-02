# Quick Scraper PHP Composer SDK

<img src="https://app.quickscraper.co/assets/images/quick_scraper_logo_3.png" width="300" />


## Get Free Access (Free Forever)

* Register yourself here [https://app.quickscraper.co/auth/register](https://app.quickscraper.co/auth/register)

##### Please Feel free to create Issue for any help !


## Installation

``` bash
composer require quickscraper/sdk
```

## Examples 1


```php

<?php
require_once './vendor/autoload.php';
use QuickScraper\Main\QuickScraperClass;
$sdk =  new QuickScraperClass('Your Quickscraper Api Key');
print_r($sdk->getHtml("Enter Your Scraping URL"));

?>
```


## Do you need an expert?

Are you finding a developer for your world-class product? If yes, please contact here. [Submit your project request here.](https://goo.gl/forms/UofdG5GY5iHMoUWg2)
Originally by [Bhushankumar L](mailto:bhushankumar.lilapara@gmail.com).
