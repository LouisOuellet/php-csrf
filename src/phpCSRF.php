<?php

//Declaring namespace
namespace LaswitchTech\phpCSRF;

//Import phpLogger class into the global namespace
use LaswitchTech\phpLogger\phpLogger;

//Import Exception class into the global namespace
use \Exception;

class phpCSRF {

  const FIELD = 'csrf';
  const LENGTH = 32;

  private $hash = null;
  private $field = self::FIELD;
  private $length = self::LENGTH;

	// Logger
  private $Logger;
	private $Level = 1;

  /**
   * Create a new phpCSRF instance.
   *
   * @param  string|null  $field
   * @return void
   * @throws Exception
   */
  public function __construct($field = self::FIELD){

    // Initiate phpLogger
    $this->Logger = new phpLogger(['csrf' => 'log/csrf.log']);

    // Configure phpLogger
    $this->Logger->config('ip',true);
    $this->Logger->config('rotation',false);
    $this->Logger->config('level',$this->Level);

    // Configure default field to retrieve token
    if(is_string($field)){
      $this->field = $field;
    }

    // Configure Cookie Scope
    if(session_status() < 2){
      ini_set('session.cookie_samesite', 'Strict');
      ini_set('session.cookie_secure', 'On');
    }

    // Setup CSRF Token
    if(session_status() === PHP_SESSION_NONE){
      $this->Logger->error("Unable to find a session.");
      throw new Exception("Unable to find a session.");
    }

    // Generate Token
    $this->generate();
  }

  /**
   * Configure Library.
   *
   * @param  string  $option
   * @param  bool|int  $value
   * @return void
   * @throws Exception
   */
  public function config($option, $value){
		try {
			if(is_string($option)){
	      switch($option){
	        case"field":
	          if(is_string($value)){
	            $this->field = $value;
	          } else{
	            throw new Exception("2nd argument must be a string.");
	          }
	          break;
	        case"length":
	          if(is_int($value)){
              $this->length = $value;
	          } else{
	            throw new Exception("2nd argument must be an integer.");
	          }
	          break;
	        case"level":
	          if(is_int($value)){

							// Logging Level
	            $this->Level = $value;

							// Configure phpLogger
					    $this->Logger->config('level',$this->Level);
	          } else{
	            throw new Exception("2nd argument must be an integer.");
	          }
	          break;
	        default:
	          throw new Exception("unable to configure $option.");
	          break;
	      }
	    } else{
	      throw new Exception("1st argument must be as string.");
	    }
		} catch (Exception $e) {
			$this->Logger->error('Error: '.$e->getMessage());
		}

    return $this;
  }

  /**
   * Generate token.
   *
   * @param  int|null  $length
   * @return void
   * @throws Exception
   */
  public function generate($length = self::LENGTH){
    if(is_int($length)){
      if(!isset($_SESSION[$this->field])){ $_SESSION[$this->field] = bin2hex(random_bytes($length)); }
      $this->hash = $_SESSION[$this->field];
    } else {
      $this->Logger->error("Invalid length.");
      throw new Exception("Invalid length.");
    }
  }

  /**
   * Get token.
   *
   * @return string $this->hash
   */
  public function token(){
    return $this->hash;
  }

  /**
   * Validate a token.
   *
   * @param  string|null  $token
   * @return boolean
   * @throws Exception
   */
  public function validate($token = null){
    if($token == null && !empty($_REQUEST[$this->field])){
      $token = $_REQUEST[$this->field];
    }
    if($token != null){
      if(is_string($token)){
        if($this->hash != null && hash_equals($token, $this->hash)){
          return true;
        } else {
          $this->Logger->error("Invalid token.");
        }
      } else {
        $this->Logger->error("Token was not sanitized.");
      }
    } else {
      $this->Logger->error("Unable to validate token.");
    }
    return false;
  }
}
