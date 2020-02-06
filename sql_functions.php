<?php
  function get_result($cur_dbcon, $sql)
  {
    if($result = mysqli_query($cur_dbcon, $sql)) {
      while(mysqli_more_results($cur_dbcon) && mysqli_next_result($cur_dbcon)){}
      if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)){
          $result_set[] = $row;
        }
      } else {
        $result_set[0]['message']= 'no rows';
      }
      mysqli_free_result($result);
    }
    else {
      $result_set[0]['message'] = 'Error: '.mysqli_error($cur_dbcon);
    }
    return $result_set;
  }

  function get_status($cur_dbcon, $sql)
  {
    if($result = mysqli_query($cur_dbcon, $sql)) {
      while(mysqli_more_results($cur_dbcon) && mysqli_next_result($cur_dbcon)){}
      $row = mysqli_fetch_assoc($result);
      $status = $row['message'];
      mysqli_free_result($result);
    }
    else {
      $status = 'Error: '.mysqli_error($cur_dbcon);
    }
    return $status;
  }

  function group_level_one_by_only_one_key($result_array, $sort_by_key, $sorted_key_value)
  {
    $temp_array = [];
    $new_key = '';
    $old_key = '';
    $index = -1;
    foreach ($result_array as $key => $value)
    {
      $new_key = $value[$sort_by_key];
      if ($new_key != $old_key)
      {
        ++$index;
        $temp_array[$index][$sort_by_key] = $value[$sort_by_key];
        $temp_array[$index][$sorted_key_value] = $value[$sorted_key_value];
        unset($value[$sort_by_key]);
        unset($value[$sorted_key_value]);
        $temp_array[$index]['details'][] = $value;
      }
      else {
        unset($value[$sort_by_key]);
        unset($value[$sorted_key_value]);
        $temp_array[$index]['details'][] = $value;
      }
      $old_key = $new_key;
    }
    return $temp_array;
  }
?>
