<?php
// group_master gm
$sql = "SELECT
  gm.group_name,
  gm.group_address,
  gm.group_int_rate
  FROM group_master gm";

if(mysqli_query($dbcon, $sql)) {
  $result = mysqli_query($dbcon, $sql);
  if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)){
      $groups[] = $row;
    }
    mysqli_free_result($result);
  } else {
    // echo 'No result found';
  }
} else {
  echo 'Error: '.mysqli_error($dbcon);
}
