<?php
// payable_master pm
$sql = "UPDATE payable_master pm
  SET pm.payable_amount = '$payable_amount',
      pm.payable_int_amount = '$payable_int_amount'
  WHERE pm.customer_id = '{$_POST['customer_id']}'";
        
if(mysqli_query($dbcon, $sql)) {
  echo 'Saved';
} else {
  echo 'Error: '.mysqli_error($dbcon);
}
