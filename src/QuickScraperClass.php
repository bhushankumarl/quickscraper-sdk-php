<?php

namespace QuickScraper\Main;

use Exception;
use QuickScraper\Constants\Config;
use GuzzleHttp\Client;


class QuickScraperClass
{
    private $accessToken = '';
    private $parseUrl;
    private $baseUrl;
    private $DEFAULT = array(
      "CLIENT" =>'NODEJS_CLIENT_LIB',
      "HOST" => ''
    );
    
    public function __construct(string $accessToken)
    {
      $this->loadPackageFiles(__DIR__."/../");
      $this->DEFAULT['HOST'] = (new Config)->getApiUrl();
      $this->parseUrl = $this->DEFAULT['HOST'].'parse';
      if ($accessToken) {
        $this->setAccessToken($accessToken);
      }
    }
    
    public function sayHello($name): string
    {
        return sprintf("Hello!".$this->baseUrl.ucfirst($name));
    }
    
    public function setHost(string $host): string
    {
      if ($host) {
          return $this->parseUrl = $host.'parse';
      }
    }
    
    public function setAccessToken(string $accessToken): string
    {
        return $this->accessToken = $accessToken;
    }
    public function getHtml(string $url)
    {
      $requestUrl = $this->prepareRequestUrl($url);
      $headers = $this->prepareHeaders();
      $options = array(
        'headers'=> $headers
      );
      try {
        // $responses = Promise\Utils::settle($promises)->wait();
        $httpClient = new Client();
        $response = $httpClient->getAsync($requestUrl, $options)->wait();

        return array(
          'data'=>$response->getBody()->getContents(),
          // 'metadata'=>$metadata
        );
      } catch (\Throwable $th) {
        throw new Exception($th);
      }
    }
    private function prepareRequestUrl(string $url): string
    {
        $requestUrl = $this->parseUrl.'?access_token='.$this->accessToken.'&URL='.$url;
        return $requestUrl;
    }
    private function prepareHeaders() {
      $headers = array(
        'client' => $this->DEFAULT['CLIENT']
      );
      return $headers;
    }
    public function writeHtmlToFile(string $url,string $filePath) {
      $isFileExits = fopen($filePath,'w');
      if (!$isFileExits) {
        throw new Exception('File does not exits.');
      }
      // Open the file to get existing content
      $current = file_get_contents($filePath);
      // Append a new person to the file
      $getHtml = $this->getHtml($url);
      // Write the contents back to the file
      file_put_contents($filePath, $getHtml);
      fclose($isFileExits);
      return $getHtml;
    }
    // Load all package from the project
    public function loadPackageFiles($dir)
    {
        $composer = json_decode(file_get_contents("$dir/composer.json"), 1);
        $namespaces = $composer['autoload']['psr-4'];

        // Foreach namespace specified in the composer, load the given classes
        foreach ($namespaces as $namespace => $classpaths) {
            if (!is_array($classpaths)) {
                $classpaths = array($classpaths);
            }
            spl_autoload_register(function ($classname) use ($namespace, $classpaths, $dir) {
                // Check if the namespace matches the class we are looking for
                if (preg_match("#^".preg_quote($namespace)."#", $classname)) {
                    // Remove the namespace from the file path since it's psr4
                    $classname = str_replace($namespace, "", $classname);
                    $filename = preg_replace("#\\\\#", "/", $classname).".php";
                    foreach ($classpaths as $classpath) {
                        $fullpath = $dir."/".$classpath."/$filename";
                        if (file_exists($fullpath)) {
                            include_once $fullpath;
                        }
                    }
                }
            });
        }
    }
}