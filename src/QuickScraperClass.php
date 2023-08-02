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
    'Client-Version' => '2.7'
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
      if (($parseOptions['customSelectors'] && sizeof($parseOptions['customSelectors']) > 0) || $parseOptions['formData']) {
        $bodyData = $this->prepareRequestBody($url, $parseOptions);
        echo 'here is echo';
        echo json_encode($bodyData);
        $gotOptions['body'] = json_encode($bodyData);
        $response = $httpClient->postAsync($url, $gotOptions)->wait();
        return $response;
      }
      echo 'here is not a post request';
      $requestUrl = $this->prepareRequestUrl($url, $parseOptions);
      $response = $httpClient->getAsync($requestUrl, $gotOptions)->wait();
      $responseObject = (Object) array(
        'data' => $response->getBody()->getContents()
      );
      return json_encode($responseObject, JSON_HEX_TAG);
    } catch (RequestException $exception) {
      $response = $exception->getResponse();
      $responseError = json_decode((string) $response->getBody());
      if ($responseError->message && $responseError->statusCode) {
        $statusCode = $responseError->statusCode ? $responseError->statusCode : 530;
        http_response_code($statusCode);
        // return json_encode($responseError);
        throw new \Exception($responseError->message, $statusCode);
      }
      $statusCode = 530;
      $message = 'Failed to process request';
      $type = 'UNKNOWN';
      $throwError = array('message' => $message, 'status' => $statusCode);
      http_response_code($statusCode);
      // return json_encode($throwError);
      throw new \Exception($throwError['message'], $statusCode);
    }
  }
  public function post(string $url, array $parseOptions = [])
  {
    $response = $this->getHtml($url, $parseOptions);
    return $response;
  }

  private function put(string $url, array $parseOptions = [])
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
    if (property_exists($extractJson, 'data')) {
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
    if (isset($parseOptions['device_type']) && $parseOptions['device_type'] !== null) {
      $urlOptions['device_type'] = $parseOptions['device_type'];
    }
    if (isset($parseOptions['parserSubscriptionId']) && $parseOptions['parserSubscriptionId'] !== null) {
      $urlOptions['parserSubscriptionRequestId'] = $parseOptions['parserSubscriptionId'];
    }
    if (isset($parseOptions['webhookRequestId']) && $parseOptions['webhookRequestId'] !== null) {
      $urlOptions['webhookRequestId'] = $parseOptions['webhookRequestId'];
    }
    if (isset($parseOptions['isScroll'])) {
      $urlOptions['isScroll'] = $parseOptions['isScroll'];
    }
    if (isset($parseOptions['scrollTimeout'])) {
      $urlOptions['scrollTimeout'] = $parseOptions['scrollTimeout'];
    }
    if (isset($parseOptions['isPabbly'])) {
      $urlOptions['isPabbly'] = $parseOptions['isPabbly'];
    }
    if (isset($parseOptions['isZapier'])) {
      $urlOptions['isZapier'] = $parseOptions['isZapier'];
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

  public function getData(string $url, array $parseOptions = [])
  {
    $getHtml = $this->getHtml($url, $parseOptions);
    return $getHtml;
  }

  public function account()
  {
    $requestUrl = $this->DEFAULT['HOST'] . 'account/?access_token=' . $this->accessToken;
    try {
      $httpClient = new Client();
      $response = $httpClient->getAsync($requestUrl)->wait();
      return json_encode($response->getBody()->getContents(), JSON_HEX_TAG);
    } catch (RequestException $exception) {
      $response = $exception->getResponse();
      $responseError = json_decode((string) $response->getBody());
      if ($responseError->message && $responseError->statusCode) {
        $statusCode = $responseError->statusCode ? $responseError->statusCode : 530;
        http_response_code($statusCode);
        // return json_encode($responseError);
        throw new \Exception($responseError->message, $statusCode);
      }
      $statusCode = 530;
      $message = 'Failed to process request';
      $type = 'UNKNOWN';
      $throwError = array('message' => $message, 'status' => $statusCode);
      http_response_code($statusCode);
      // return json_encode($throwError);
      throw new \Exception($throwError['message'], $statusCode);
    }
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

  private function postContent($url, $parseOptions, $headers)
  {
    try {
      $httpClient = new Client();
      $response = $httpClient->postAsync($url, $parseOptions)->wait();
      $responseObject = (Object) array(
        'data' => $response->getBody()->getContents()
      );
      return json_encode($responseObject, JSON_HEX_TAG);
    } catch (RequestException $exception) {
      $response = $exception->getResponse();
      $responseError = json_decode((string) $response->getBody());
      if ($responseError->message && $responseError->statusCode) {
        $statusCode = $responseError->statusCode ? $responseError->statusCode : 530;
        http_response_code($statusCode);
        // return json_encode($responseError);
        throw new \Exception($responseError->message, $statusCode);
      }
      $statusCode = 530;
      $message = 'Failed to process request';
      $type = 'UNKNOWN';
      $throwError = array('message' => $message, 'status' => $statusCode);
      http_response_code($statusCode);
      // return json_encode($throwError);
      throw new \Exception($throwError['message'], $statusCode);
    }
  }

  private function prepareRequestBody($url, $parseOptions){
    $urlOptions = array(
      'access_token' => $this->accessToken,
      'URL' => $url
    );
    if (isset($urlOptions['premium']) && $urlOptions['premium'] === true) {
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
    if (isset($parseOptions['device_type']) && $parseOptions['device_type'] !== null) {
      $urlOptions['device_type'] = $parseOptions['device_type'];
    }
    if (isset($parseOptions['parserSubscriptionId']) && $parseOptions['parserSubscriptionId'] !== null) {
      $urlOptions['parserSubscriptionRequestId'] = $parseOptions['parserSubscriptionId'];
    }
    if (isset($parseOptions['webhookRequestId']) && $parseOptions['webhookRequestId'] !== null) {
      $urlOptions['webhookRequestId'] = $parseOptions['webhookRequestId'];
    }
    if (isset($parseOptions['isScroll'])) {
      $urlOptions['isScroll'] = $parseOptions['isScroll'];
    }
    if (isset($parseOptions['scrollTimeout'])) {
      $urlOptions['scrollTimeout'] = $parseOptions['scrollTimeout'];
    }
    if (isset($parseOptions['isPabbly'])) {
      $urlOptions['isPabbly'] = $parseOptions['isPabbly'];
    }
    if (isset($parseOptions['isZapier'])) {
      $urlOptions['isZapier'] = $parseOptions['isZapier'];
    }
    if (isset($parseOptions['customSelectors'])) {
      $urlOptions['customSelectors'] = $parseOptions['customSelectors'];
		}
		if (isset($parseOptions['keepSelection'])) {
      $urlOptions['keepSelection'] = $parseOptions['keepSelection'];
		}
		if (isset($parseOptions['formData'])) {
      $urlOptions['formData'] = $parseOptions['formData'];
		}
		if (isset($parseOptions['isKeepFormDataSelection'])) {
      $urlOptions['isKeepFormDataSelection'] = $parseOptions['isKeepFormDataSelection'];
		}

    return $urlOptions;
  }
}
