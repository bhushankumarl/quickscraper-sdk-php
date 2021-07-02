<?php

namespace QuickScraper\Main;

use QuickScraper\Constants\Config;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class QuickScraperClass
{
  private $accessToken = '';
  private $parseUrl;
  private $DEFAULT = array(
    'Client' => 'PHP_CLIENT_LIB',
    'HOST' => '',
    'Client-Version' => '1.0.3'
  );

  /**
   * @param string $accessToken
   */
  public function __construct($accessToken = '')
  {
    $this->loadPackageFiles(__DIR__ . '/../');
    $this->DEFAULT['HOST'] = (new Config)->getBaseUrl();
    $this->parseUrl = $this->DEFAULT['HOST'] . 'parse';
    if ($accessToken) {
      $this->setAccessToken($accessToken);
    }
  }

  public function setHost(string $host): string
  {
    if ($host) {
      return $this->parseUrl = $host . 'parse';
    }
  }

  public function setAccessToken(string $accessToken): string
  {
    return $this->accessToken = $accessToken;
  }
  /**
   * @return mixed
   */
  public function getHtml(string $url, array $parseOptions = [])
  {
    $requestUrl = $this->prepareRequestUrl($url, $parseOptions);
    $customHeaders = null;
    if (isset($parseOptions['headers'])) {
      $customHeaders = $parseOptions['headers'];
    }
    $headers = $this->prepareHeaders($customHeaders, $parseOptions);
    $gotOptions = array(
      'headers' => $headers,
      'verify' => false
    );
    try {
      $httpClient = new Client();
      $response = $httpClient->getAsync($requestUrl, $gotOptions)->wait();
      $quotaMax = $response->getHeaders()['x-qs-quota-max'];
      $quotaRemainig = $response->getHeaders()['x-qs-quota-remaining'];
      $responseObject =  (Object) array(
        'data' => $response->getBody()->getContents(),
        'metadata' => array(
          'quotaMax' => $quotaMax[0],
          'quotaRemaining' => $quotaRemainig[0],
        ),
      );
      return json_encode($responseObject, JSON_HEX_TAG);
    } catch (RequestException  $exception) {
      $response = $exception->getResponse();
      $responseError = json_decode((string) $response->getBody());
      if ($responseError->message && $responseError->statusCode) {
        $statusCode =  $responseError->statusCode ? $responseError->statusCode : 530;
        http_response_code($statusCode);
        return json_encode($responseError);
      }
      $statusCode = 530;
      $message = 'Failed to process request';
      $type = 'UNKNOWN';
      $throwError = array('message' => $message, 'status' => $statusCode);
      http_response_code($statusCode);
      return json_encode($throwError);
    }
  }
  public function post(string $url, array $parseOptions = [])
  {
    $response = $this->getHtml($url, $parseOptions);
    return $response;
  }

  public function put(string $url, array $parseOptions = [])
  {
    $response = $this->getHtml($url, $parseOptions);
    return $response;
  }

  public function writeHtmlToFile(string $url, string $filePath)
  {
    $isFileExits = fopen($filePath, 'w');
    if (!$isFileExits) {
      $message = 'File does not exits.';
      $statusCode = 400;
      $throwError = array('message' => $message, 'status' => $statusCode);
      http_response_code($statusCode);
      return json_encode($throwError);
    }
    $current = file_get_contents($filePath);
    $getHtml = $this->getHtml($url);
    $extractJson = json_decode($getHtml);
    if(property_exists($extractJson,'data')){
      file_put_contents($filePath, $extractJson->data);
    }
    fclose($isFileExits);
    return $getHtml;
  }
  private function prepareRequestUrl(string $url, array $parseOptions = [])
  {
    $urlOptions = array(
      'access_token' => $this->accessToken,
      'URL' => $url
    );
    if (isset($parseOptions['premium']) && $parseOptions['premium'] === true) {
      $urlOptions['premium'] = 'true';
    }
    if (isset($parseOptions['render']) && $parseOptions['render'] === true) {
      $urlOptions['render'] = 'true';
    }
    if (isset($parseOptions['session_number']) && $parseOptions['session_number'] !== '') {
      $urlOptions['session_number'] = $parseOptions['session_number'];
    }
    if (isset($parseOptions['country_code']) && $parseOptions['country_code'] !== '') {
      $urlOptions['country_code'] = $parseOptions['country_code'];
    }
    if (isset($parseOptions['keep_headers']) && $parseOptions['keep_headers'] === true) {
      $urlOptions['keep_headers'] = 'true';
    }
    $requestUrl = $this->parseUrl . '?' . http_build_query($urlOptions, '', '&');
    return $requestUrl;
  }
  /**
   * @param array|null $customHeaders
   * @param array|null $parseOptions
   */
  private function prepareHeaders(array $customHeaders = null, array $parseOptions = null)
  {
    $headers = array(
      'Client' => $this->DEFAULT['Client'],
      'Client-Version' => $this->DEFAULT['Client-Version']
    );
    $mergedHeaders = null;
    if ($customHeaders !== null) {
      $mergedHeaders = array_merge($headers, $customHeaders);
    }
    if ($parseOptions !== null && isset($parseOptions['keep_headers']) && $parseOptions['keep_headers'] === true) {
      return $mergedHeaders;
    }
    return $headers;
  }

  // Load all package from the project
  public function loadPackageFiles($dir)
  {
    $composer = json_decode(file_get_contents($dir . '/composer.json'), 1);
    $namespaces = $composer['autoload']['psr-4'];
    // Foreach namespace specified in the composer, load the given classes
    foreach ($namespaces as $namespace => $classpaths) {
      if (!is_array($classpaths)) {
        $classpaths = array($classpaths);
      }
      spl_autoload_register(function ($classname) use ($namespace, $classpaths, $dir) {
        // Check if the namespace matches the class we are looking for
        if (preg_match('#^' . preg_quote($namespace) . '#', $classname)) {
          // Remove the namespace from the file path since it's psr4
          $classname = str_replace($namespace, '', $classname);
          $filename = preg_replace('#\\\\#', '/', $classname) . '.php';
          foreach ($classpaths as $classpath) {
            $fullpath = $dir . '/' . $classpath . '/$filename';
            if (file_exists($fullpath)) {
              include_once $fullpath;
            }
          }
        }
      });
    }
  }
}
