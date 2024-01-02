<?php
require_once './vendor/autoload.php';
$quickScraperClient = new QuickScraper\Main\QuickScraperClass();
$parseOptions = array(
    'URL' => 'http://ip-api.com/json',
    'parserSubscriptionId' => '2a4a1eb9-ce29-5f28-b523-0eacafaceda2',
    'parserResponseType' => 'csv'
);
$quickScraperClient->setAccessToken('SmAqNmMdVmvq1i5Eq6Vn5aAUd');
$response = $quickScraperClient->getHtml('http://ip-api.com/json', $parseOptions);
print_r(json_decode($response));
?>