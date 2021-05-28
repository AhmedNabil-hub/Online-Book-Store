<?php

function check_errors($name, $type, $tmp_name, $error, $size, $formErrors){
  if ($error == 0){
    $errors = array();
    @$file_ext = strtolower(end(explode('.', $name)));

    if (!in_array($file_ext, allowed_exts)){
      $errors[] = 'this photo extension in not allowed';
    }

    if ($size > max_size){
      $errors[] = 'Photo can\'t be more than '.max_size;
    }

    if (empty($errors) && empty($formErrors)){
      $new_name = rand(0, 100000) . '.' . $file_ext;
      move_uploaded_file($tmp_name, $_SERVER["DOCUMENT_ROOT"] . '/book-store/frontend/images/uploads/' . $new_name);
      global $new_file_name;
      $new_file_name =  'frontend/images/uploads/' . $new_name;
    } 

  } else {
    $errors[] = 'Please upload a file';
  }

  return $errors;
}
