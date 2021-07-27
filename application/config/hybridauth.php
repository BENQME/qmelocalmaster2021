<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $config = dirname(__FILE__) . '/library/config.php';
// require_once( "/third_party/hybridauth/hybridauth.php" );
// require_once APPPATH.'/third_party/hybridauth/hybridauth.php';
/*
| -------------------------------------------------------------------------
| HybridAuth settings
| -------------------------------------------------------------------------
| Your HybridAuth config can be specified below.
|
| See: https://github.com/hybridauth/hybridauth/blob/v2/hybridauth/config.php
*/



$config['hybridauth'] = array(
  "providers" => array(
    "OpenID" => array(
      "enabled" => FALSE,
    ),
    "Yahoo" => array(
      "enabled" => FALSE,
      "keys" => array("id" => "", "secret" => ""),
    ),
    
        "Google" => array (
            "base_url" => base_url('hauth/endpoint'),
          "enabled" => true,
          "keys"    => array ( "id" => "391792063709-7b9u950vtdk3hur5if0ig7oubqobq9g7.apps.googleusercontent.com", "secret" => "6LEw9ktdOs8k2jWtstVJmDlb"),
"redirect_uri" => "https://qmelocal.qmebiz.com/hauth/endpoint?hauth.done=Google",
"scope" => "https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.google.com/m8/feeds/",
    ),
    "Facebook" => array(
      "enabled" => TRUE,
      "keys" => array("id" => "253459605807064", "secret" => "5254a780fc99ef52c175142e7f4e1932"),
      "trustForwarded" => FALSE,
    ),
    "Twitter" => array(
      "enabled" => TRUE,
      "keys" => array("key" => "", "secret" => ""),
      "includeEmail" => FALSE,
    ),
    "LinkedIn" => array(
      "enabled" => FALSE,
      "keys" => array("id" => "", "secret" => ""),
    ),
  ),
  // If you want to enable logging, set 'debug_mode' to true.
  // You can also set it to
  // - "error" To log only error messages. Useful in production
  // - "info" To log info and error messages (ignore debug messages)
  // "debug_mode" => ENVIRONMENT === 'development',
  // Path to file writable by the web server. Required if 'debug_mode' is not false
  "debug_file" => APPPATH . 'logs/hybridauth.log',
);
