<?php
require_once __DIR__.'/../../includes/ajax-session-check.php';

$fieldList = '';
$valueList = '';
foreach ($_POST as $key => $value) {
  $fieldList .= $key.',';
  $valueList .= "'".(mysqli_real_escape_string($dbcon, $value))."',";
};
$fieldList = rtrim($fieldList, ',');
$valueList = rtrim($valueList, ',');

$sql = "INSERT INTO group_master ($fieldList) VALUES($valueList)";
// echo $sql;
// die();

if(mysqli_query($dbcon, $sql)) {
  echo 'Saved';
} else {
  echo 'Error: '.mysqli_error($dbcon);
}
