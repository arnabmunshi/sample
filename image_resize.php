<?php
image_custome_resize($required_width, $required_height, $image_file_location, $image_file_location_after_resizing);

function image_custome_resize($required_width, $required_height, $filename, $newfilename) {
  // $filename = 'download.jpg';
  list($original_width, $original_height) = getimagesize($filename);

  $new_height = round(($required_width/$original_width)*$original_height);
  $new_width = round(($required_height/$original_height)*$original_width);

  if ($new_height > $required_height) {
    $thumb = imagecreatetruecolor($required_width, $new_height);
    $source = imagecreatefromjpeg($filename);

    imagecopyresized($thumb, $source, 0, 0, 0, 0, $required_width, $new_height, $original_width, $original_height);

    imagejpeg($thumb, $newfilename, 75);

    image_vertical_crop($required_width, $required_height, $new_height, $newfilename);
  } else if ($new_width > $required_width) {
    $thumb = imagecreatetruecolor($new_width, $required_height);
    $source = imagecreatefromjpeg($filename);

    imagecopyresized($thumb, $source, 0, 0, 0, 0, $new_width, $required_height, $original_width, $original_height);

    imagejpeg($thumb, $newfilename, 75);

    image_horizontal_crop($required_width, $required_height, $new_width, $newfilename);
  } else if ($required_width == $original_width && $required_height == $original_height) {
    $newfile = $newfilename;

    if (!copy($filename, $newfile)) {
      echo "failed to copy";
    }
  }
}

function image_vertical_crop($required_width, $required_height, $new_height, $filename) {
  // The file
  // $filename = 'thumb2.jpg';

  // Get new dimensions
  list($width_orig, $height_orig) = getimagesize($filename);

  // Resample
  $thumb = imagecreatetruecolor($required_width, $required_height);
  $source = imagecreatefromjpeg($filename);

  $crop_from_y = round(($new_height - $required_height)/2);
  imagecopyresized($thumb, $source, 0, 0, 0, $crop_from_y, $required_width, $required_height, $width_orig, $required_height);

  // Output
  imagejpeg($thumb, $filename, 75);
}

function image_horizontal_crop($required_width, $required_height, $new_width, $filename) {
  // The file
  // $filename = 'thumb2.jpg';

  // Get new dimensions
  list($width_orig, $height_orig) = getimagesize($filename);

  // Resample
  $thumb = imagecreatetruecolor($required_width, $required_height);
  $source = imagecreatefromjpeg($filename);

  $crop_from_x = round(($new_width - $required_width)/2);
  imagecopyresized($thumb, $source, 0, 0, $crop_from_x, 0, $required_width, $required_height, $required_width, $height_orig);

  // Output
  imagejpeg($thumb, $filename, 75);
}
?>
