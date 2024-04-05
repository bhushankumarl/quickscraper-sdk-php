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
      //This field is added to set cookis,authorizarion token etc from request header.
    "isKeepHeaders" => 'true',//This value will be true when we want to use header
    'customRequestHeaders' => array('X-My-Custom-Header'=> 'QS-APP')//Supports values like `'Accept-Encoding': 'gzip,deflate,compress'`
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
    'country_code'=> 'us'//Add your Geotargeting country which you are selecting from request page,for example, for Canada value like `CA`,for China value like `CN`
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
    'premium'=> true //Up or premium proxies will be picked
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
    'device_type'=> 'mobile'//Add value `mobile` if the device which you are using is mobile and no need to provide this option if want to scrap site as desktop view
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
    'parserSubscriptionId'=> 'YOUR_PARSER_SUBSCRIPTION_ID'//Get the parser subscription id from request page when you select parser and paste here, for example value like '4a0360ea-042a-555e-b214-e3054a400f2a'
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
    'webhookRequestId' => 'YOUR_WEBHOOK_REQUEST_ID'//Get the webhook id from dashboard and paste here, for example value like `2233-34jkjsd-324jkds-3243kh`
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
    //This field is added when we want to scrap data after login or sign up.
    'formData' => array(
        'formSelector' => 'FORM_SELECTOR',//Supports values like `'form[class="unique_class"]'`
        'submitButtonSelector' => 'SUBMIT_BUTTON_SELECTOR',//Supports values like `'button[class="unique_class"]'`
        'formSelectorScript' => 'FORM_SELECTOR_SCRIPT',//Supports values like `document.getElementById("demo")`
        'submitButtonSelectorScript' => 'SUBMIT_BUTTON_SELECTOR_SCRIPT',//Supports values like `document.
        'formFields' => array(
            array(
                'value' => 'VALUE_TO_PASS_IN_FORM',//Add value of form input fields
                'selectorScript' => 'SELECT_INPUT',//Supports values like `'input[class="unique_class"]','span[class="unique_class"]'`
                'isScript' => 'BOOLEAN'//If your selector has JavaScript code then make this true
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
    //These dynamic inputs field is required when some input fields are required to get data of page
    'dynamicInputs' => array(
		array(
			'name' => 'YOUR_INPUT_NAME',//Name stands for input name field like `Username`,`password`,`limit` etc
			"value" => 'YOUR_VALUE' //Value of name field like `abc`,`123456789`,`25`
		)
	),
));
print_r(json_decode($response));
```
### Add Actions with Parser
``` php
<?php
require_once './vendor/autoload.php';
$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('https://www.hilton.com/en/locations/india/?WT.mc_id=zLADA0IN1MB2PSH3GGL4INTCRB5dkt6MULTIBR7en_&epid!_&ebuy!&&&&&gad_source=1&gclid=CjwKCAiAvJarBhA1EiwAGgZl0HWfZEaLc_HWhRFRxTT3gs8pwQvFZKtLPNMj3szkjCbFzlef4ox_XxoCGDYQAvD_BwE&gclsrc=aw.ds', array(
    'parserSubscriptionId' => 'YOUR_PARSER_SUBSCRIPTION_ID',
    'customSelectors' => array(
		array(
			'name' => 'YOUR_VALUE',//Name stands for action name and it supports only 2 actions like `waitForElement` and `click`
			'selectorScript' => 'YOUR_SELECTOR',//Supports values like `'a[href="google.com"]', 'span[class="unique_class"]', document.getElementById("demo")`
            'options' => null,//This options support timeout feature only like `{"timeout":3000}`
			'isScript'=> false //If your selector has JavaScript code then make this true
		),
        'keepSelection' => true,
	),
));
print_r(json_decode($response));
```

### Scroll To Bottom Of The Page
``` php
<?php
require_once './vendor/autoload.php';
$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('YOUR_REQUEST_URL', array(
    'isScroll' => true,
    'scrollTimeout' => 1000, // Consider as milliseconds, wait to page to scrap
    
));
print_r(json_decode($response));
```

## Do you need an expert?

Are you finding a developer for your world-class product? If yes, please contact here.
Originally by [QuickScraper Developers - app@quickscraper.co](mailto:app@quickscraper.co).
