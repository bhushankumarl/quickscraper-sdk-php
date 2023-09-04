# Quick Scraper PHP Composer SDK

<img src='https://app.quickscraper.co/assets/images/quick_scraper_logo_3.png' width='300' />


## Get Free Access (Free Forever)

* Register yourself here [https://app.quickscraper.co/auth/register](https://app.quickscraper.co/auth/register)

##### Please Feel free to create Issue for any help !


## Installation

``` bash
composer require quickscraper/sdk
```

### Basic usage


```php

<?php
require_once './vendor/autoload.php';
$sdk =  new QuickScraper\Main\QuickScraperClass();
$sdk->setAccessToken('YOUR_ACCESS_TOKEN');
$html = $sdk->getHtml('https://mylocation.org');
print_r(json_decode($html));
?>
```
### Rendering Javascript

```php
<?php
require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', array(
    'render'=> 'true'
  )
);
print_r(json_decode($response));

```

### Custom Headers

```php
<?php
require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/headers', array(
    "keep_headers" => true,
    'headers' => array('X-My-Custom-Header'=> 'QS-APP')
  )
);
print_r(json_decode($response));

```

### Geographic Location

```php
<?php
require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', array(
    'country_code'=> 'us'
));
print_r(json_decode($response));
```

### Premium Residential/Mobile Proxy Pools

``` php
<?php
require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', array(
    'premium'=> true
));
print_r(json_decode($response));
```

### Account Information

``` php
<?php
require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->account();
print_r(json_decode($response));
```

### Device Type

``` php
<?php
require_once './vendor/autoload.php';
$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', array(
    'device_type'=> 'mobile'
));
print_r(json_decode($response));
```
### Parser Addon

``` php
<?php
require_once './vendor/autoload.php';
$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', array(
    'parserSubscriptionId'=> 'YOUR_PARSER_SUBSCRIPTION_ID'
));
print_r(json_decode($response));
```
### Webhook Addon

``` php
<?php
require_once './vendor/autoload.php';
$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', array(
    'webhookRequestId' => 'YOUR_WEBHOOK_REQUEST_ID'
));
print_r(json_decode($response));
```

### Submit form data
``` php
<?php
require_once './vendor/autoload.php';
$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', array(
    'webhookRequestId' => 'YOUR_WEBHOOK_REQUEST_ID',
    'formData' => array(
        'formSelector' => 'FORM_SELECTOR',
        'submitButtonSelector' => 'SUBMIT_BUTTON_SELECTOR',
        'formSelectorScript' => 'FORM_SELECTOR_SCRIPT',
        'submitButtonSelectorScript' => 'SUBMIT_BUTTON_SELECTOR_SCRIPT',
        'formFields' => array(
            array(
                'value' => 'VALUE_TO_PASS_IN_FORM',
                'selectorScript' => 'SELECT_INPUT',
                'isScript' => 'BOOLEAN'
            )
        ),
    ),
    'isKeepFormDataSelection' => true
));

print_r(json_decode($response));
```

### Add Dynamic Input with Parser
``` php
<?php
require_once './vendor/autoload.php';
$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', array(
    'parserSubscriptionId' => 'YOUR_PARSER_SUBSCRIPTION_ID',
    'dynamicInputs' => array(
		array(
			'name' => 'YOUR_INPUT_NAME',
			'value' => 'YOUR_VALUE'
		)
	),
));
print_r(json_decode($response));
```

## Do you need an expert?

Are you finding a developer for your world-class product? If yes, please contact here.
Originally by [QuickScraper Developers - app@quickscraper.co](mailto:app@quickscraper.co).
