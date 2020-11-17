<?php

//retun new filename
function setFileName($type, $fileName) {
  if (isset($_FILES['fileUpload'])) {
    //a file has been uploaded
    $file_name = $_FILES['fileUpload']['name'];
    $file_size = $_FILES['fileUpload']['size'];
    $file_tmp = $_FILES['fileUpload']['tmp_name'];
    $file_type= $_FILES['fileUpload']['type'];
    $file = $type.'-'.$fileName.'.'.$ext = pathinfo($file_name, PATHINFO_EXTENSION);
    return $file;
  } else {
    return false;
  }
}


//upload file
function uploadFile($type, $fileName, $folder = '') {

  if (isset($_FILES['fileUpload'])) {
    //a file has been uploaded
    $file_name = $_FILES['fileUpload']['name'];
    $file_size = $_FILES['fileUpload']['size'];
    $file_tmp = $_FILES['fileUpload']['tmp_name'];
    $file_type= $_FILES['fileUpload']['type'];

    $newFilename = UPLOADS.''.$folder.''.$type.'-'.$fileName.'.'.$ext = pathinfo($file_name, PATHINFO_EXTENSION);

    move_uploaded_file($file_tmp, $newFilename);

    $file = $type.'-'.$fileName.'.'.$ext = pathinfo($file_name, PATHINFO_EXTENSION);

    return $file;

  } else {
    return false;
  }

}
