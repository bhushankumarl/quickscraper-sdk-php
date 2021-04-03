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
$sdk =  new QuickScraper\Main\QuickScraperClass('ACCESS_TOKEN');
print_r($sdk->getHtml('https://mylocation.org'));

?>
```
### Rendering Javascript

``` php
require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass('ACCESS_TOKEN');
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', {
    render: true
});
print_r($response);

```

### Custom Headers

``` php
require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass('ACCESS_TOKEN');
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', {
    headers: {
        'X-My-Custom-Header': 'QS-APP'
    }
});
print_r($response);

```
### Sessions

``` php
require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass('ACCESS_TOKEN');
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', {
    session_number: 'YOUR-LONG-UNIQUE-STRING'
});
print_r($response);

```

### Geographic Location

``` php
require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass('ACCESS_TOKEN');
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', {
    country_code: 'US'
});
print_r($response);
```

### Premium Residential/Mobile Proxy Pools

``` php
require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass('ACCESS_TOKEN');
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', {
    premium: true
});
print_r($response);
```

### POST/PUT Requests

``` php
require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass('ACCESS_TOKEN');
$quickScraperClient->setAccessToken('YOUR_ACCESS_TOKEN');
$responsePost = $quickScraperClient->post('http://httpbin.org/ip', {
    body: {
        'foo': 'bar'
    }
});
print_r($responsePost);

$responsePut = $quickScraperClient->put('http://httpbin.org/ip', {
    body: {
        'foo': 'bar'
    }
});
print_r($responsePut);
```


### Proxy Mode

``` php
$require_once './vendor/autoload.php';

$quickScraperClient = new QuickScraper\Main\QuickScraperClass('ACCESS_TOKEN');

$options = {
    method: 'GET',
    url: 'http://httpbin.org/ip',
    proxy: 'http://quickscraper:YOURAPIKEY@proxy-server.quickscraper.co:1008',
};
$response = $quickScraperClient->getHtml('http://httpbin.org/ip', $options);
print_r($response);

```

## Do you need an expert?

Are you finding a developer for your world-class product? If yes, please contact here. [Submit your project request here.](https://goo.gl/forms/UofdG5GY5iHMoUWg2)
Originally by [Bhushankumar L](mailto:bhushankumar.lilapara@gmail.com).
