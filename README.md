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
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', array(
    'headers'=>array('X-My-Custom-Header'=> 'QS-APP')
  )
);
print_r(json_decode($response));

```
### Sessions

```php
<?php
require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', array(
    'session_number'=> 'YOUR-LONG-UNIQUE-STRING'
));
print_r(json_decode($response));

```

### Geographic Location

```php
<?php
require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip',  array(
    'country_code'=> 'US'
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

### POST/PUT Requests

``` php
<?php
require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$responsePost = $quickScraperClient->post('http://httpbin.org/ip',array(
    'body'=> array(
        'foo'=> 'bar'
    )
));
print_r(json_decode($responsePost));

$responsePut = $quickScraperClient->put('http://httpbin.org/ip', array(
    'body'=> array(
        'foo'=> 'bar'
    )
));
print_r(json_decode($responsePut));
```


### Proxy Mode

``` php
<?php
$require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$options = {
    method: 'GET',
    url: 'http://httpbin.org/ip',
    proxy: 'http://quickscraper:YOURAPIKEY@proxy-server.quickscraper.co:1008',
};
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', $options);
print_r(json_decode($response));

```

## Do you need an expert?

Are you finding a developer for your world-class product? If yes, please contact here.
Originally by [QuickScraper Developers - app@quickscraper.co](mailto:app@quickscraper.co).
