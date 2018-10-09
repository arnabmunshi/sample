<?php
$sql = "UPDATE payable_master
        SET payable_amount = '$payable_amount',
            payable_int_amount = '$payable_int_amount'
        WHERE customer_id = '{$_POST['customer_id']}'";
        
if(mysqli_query($dbcon, $sql)) {
  echo 'Saved';
} else {
  echo 'Error: '.mysqli_error($dbcon);
}
