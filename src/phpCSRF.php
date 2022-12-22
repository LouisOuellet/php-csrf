<?php

//Declaring namespace
namespace LaswitchTech\phpCSRF;

class phpCSRF {

  protected $csrf = null;

  public function __construct(){
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
