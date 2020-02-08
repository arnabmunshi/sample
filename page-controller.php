<?php
require_once __DIR__.'/../helper/functions.php';

$request_uri = $_SERVER['REQUEST_URI'];
$server_name = $_SERVER['SERVER_NAME'];
$client_ip = $_SERVER['REMOTE_ADDR'];

$base_url = base_url();
$base_url_length = strlen($base_url);

$url = substr($request_uri, $base_url_length);
$page_name = explode('/', $url)[0];

// for search pages
// --------------------------------------------------
$question_mark_position = strpos($page_name, "?");
if ($question_mark_position > 0) {
  $page_name = substr($page_name, 0, $question_mark_position);
}
// --------------------------------------------------

if ($_SERVER['REQUEST_URI'] == base_url()) {
  $page_name = 'index';
}

// --------------------------------------------------
if (isset(explode('/', $url)[1])) {
  if (explode('/', $url)[0] == 'websites') {
    $page_name = explode('/', $url)[1];
  }
}
// --------------------------------------------------

$page_title = [
  // login and dashboard
  'index'                     => project_name(),
  'dashboard'                 => 'Dashboard - '.project_name(),
  'member-verification'       => 'Member Verification - '.project_name(),
  'events'                    => 'Events - '.project_name(),
  'reports'                   => 'Reports - '.project_name(),
  'gallery'                   => 'Gallery - '.project_name(),

  // error pages
  '404'                       => 'Page Not Found',
];

// print_r($page_title);

if ( !array_key_exists($page_name, $page_title) ) {
  $page_name = '404';
}
