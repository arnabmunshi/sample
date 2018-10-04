<?php
require __DIR__ . '/../PHPDotEnv/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__.'/..', '.env');
$dotenv->load();

$GLOBALS['project_name'] = getenv('APP_NAME');

date_default_timezone_set(getenv('TIME_ZONE'));

function project_name () {
  return $GLOBALS['project_name'];
}

function base_url () {
  $server_name = $_SERVER['SERVER_NAME'];

  if ($server_name === 'localhost') {
    $base_url = getenv('BASE_URL'); // folder name
  } else {
    $base_url = getenv('BASE_URL');
  }

  return $base_url;
}

function is_active ($page_name, $pg) {
  if ($page_name == $pg) {
    return 'active';
  }
}

function fb_date ($d) {
  $date = new DateTime($d);
  return $date->format('F d, Y'); // March 03, 2018
}

function fb_date_with_day ($d) {
  $date = new DateTime($d);
  return $date->format('l, F d, Y'); // Sunday, March 03, 2018
}

function mysql_date($d) {
  $date = new DateTime($d);
  return $date->format('Y-m-d');
}

function fb_time ($t) {
  $date = new DateTime($t);
  return $date->format('g:i A'); // 12:00 AM
}

function country_code ($country) {
  $country_list = [
    'in' => '+91',
    'bd' => '+880',
  ];
  return $country_list[$country];
}

function fb_adddays($no_of_days,$sent_date)
{
  return date('F d, Y',strtotime('+'.$no_of_days.' days',strtotime($sent_date)));
}

function get_date_differnce($today,$reg_date)
{
  return (strtotime($today)-strtotime(date('Y-m-d',strtotime($reg_date))))/86400 ;
}

// var_dump() and die()
function vdd($array_name) {
  echo '<pre>';
  var_dump($array_name);
  echo '</pre>';
}

// print_r() and die()
function prd($array_name) {
  echo '<pre>';
  print_r($array_name);
  echo '</pre>';
}

function number_formate($number, $decimal) {
  return number_format($number, $decimal, '.', ','); // 10000.879 - 10,000.88
}

?>
