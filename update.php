<?php
require_once __DIR__.'/../../includes/ajax-session-check.php';

$customer_id = $_POST['customer_id'];
unset($_POST['customer_group_id']);
unset($_POST['customer_id']);

$update_string = [];
foreach ($_POST as $key => $value) {
  $string = $key."='".mysqli_real_escape_string($dbcon, $value)."'";
  array_push($update_string, $string);
};

$data_set = implode(", ", $update_string);

$sql = "UPDATE customer_master SET $data_set WHERE customer_id = $customer_id";
// echo $sql;
// die();

if(mysqli_query($dbcon, $sql)) {
  echo 'Updated';
} else {
  echo 'Error: '.mysqli_error($dbcon);
}
