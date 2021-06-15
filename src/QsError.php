<?php

namespace QuickScraper\Main;

use Exception;

class QsError extends Exception
{
 
  private $previous;

  /**
   * @param  $message string;
   * @param  $errorCode integer;
   * @param  $statusCode integer;
   */


  public function __construct($message, $code, Exception $previous = null)
  {
    parent::__construct($message, $code);

    if (!is_null($previous)) {
      $this->previous = $previous;
    }
  }
}
