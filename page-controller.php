<?php

require_once __DIR__.'/../helper/functions.php';

$request_uri = $_SERVER['REQUEST_URI'];
$server_name = $_SERVER['SERVER_NAME'];

$base_url = base_url();
$base_url_length = strlen($base_url);

$url = substr($request_uri, $base_url_length);
$page_name = explode('/', $url)[0];

if ($_SERVER['REQUEST_URI'] == base_url()) {
  $page_name = 'index';
}

if ($page_name == 'news-events' && isset(explode('/', $url)[1])) {
  $wne_id = $_GET['wne_id'];
  require_once __DIR__.'/../models/get_newsevents_details.php';
  
  if (sizeof($news_events_details) > 0) {
    $news_events_title = $news_events_details[0]['wne_title'];
    $error_code = 0;
  } else {
    $news_events_title = 'Page not found';
    $error_code = 404;
  }

  $page_title = [
    $page_name => $news_events_title.' | News & Events | '.project_name(),
  ];
} else {
  $page_title = [
    // login and dashboard
    'index'                                 => project_name(),

    'association-desk'                      => 'Association Desk - '.project_name(),
    'about-us'                              => 'About Us - '.project_name(),
    'objectives'                            => 'Objectives - '.project_name(),
    
    // 'team'                                  => 'Team - '.project_name(),
    'gallery'                               => 'Gallery - '.project_name(),
    'news-events'                           => 'New & Events - '.project_name(),
    'contact'                               => 'Contact - '.project_name(),
    'privacy-policy'                        => 'Privacy Policy - '.project_name(),

    // BONG  PAGES
    'about-us-bong'                         => 'About Us - '.project_name(),
    'objectives-bong'                       => 'Objectives - '.project_name(),
    'association-desk-bong'                 => 'Association Desk - '.project_name(),

    // error pages
    '404'                                   => 'Page Not Found',
  ];
}

// print_r($page_title);

if ( !array_key_exists($page_name, $page_title) ) {
  $page_name = '404';
}
