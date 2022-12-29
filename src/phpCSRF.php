<?php

//Declaring namespace
namespace LaswitchTech\phpCSRF;

class phpCSRF {

  protected $csrf = null;

  public function __construct(){

    // Configure Cookie Scope
    if(session_status() < 2){
      ini_set('session.cookie_samesite', 'Strict');
      ini_set('session.cookie_secure', 'On');
    }

    // Setup CSRF Token
    if(session_status() !== PHP_SESSION_NONE){
      if(!isset($_SESSION["csrf"])){ $_SESSION["csrf"] = bin2hex(random_bytes(32)); }
      $this->csrf = $_SESSION["csrf"];
    }
  }

  public function token(){
    return $this->csrf;
  }

  public function validate(){
    return ($this->csrf != null && !empty($_REQUEST["csrf"]) && hash_equals($_REQUEST["csrf"], $this->csrf));
  }
}
