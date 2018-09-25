<?php
require_once __DIR__.'/../../includes/ajax-session-check.php';

$customer_group_id = $_GET['customer_group_id'];
$customer_aadhar_no = $_GET['aadhar_no'];

// customer_master cm
$sql = "SELECT
  cm.customer_id,
  cm.customer_name,
  cm.customer_aadhar_no
  FROM customer_master cm
  WHERE cm.customer_group_id = '{$customer_group_id}'
  AND cm.customer_aadhar_no LIKE '{$customer_aadhar_no}%'
  LIMIT 5";

// echo $sql;
// die();

if(mysqli_query($dbcon, $sql)) {
  $result = mysqli_query($dbcon, $sql);
  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
      $cm[] = $row;
    }
    mysqli_free_result($result);
  } else {
    // echo 'No result found';
    $cm = [];
  }
  echo json_encode($cm);
} else {
  echo 'Error: '.mysqli_error($dbcon);
}
