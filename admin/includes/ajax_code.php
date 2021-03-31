<?php
  ob_start();
  require_once("init.php");
  if (isset($_POST['image_name'])) {
    $user = User::find_by_id($_POST['user_id']);
    $result = $user->ajax_save_user_image($_POST['image_name']);
    if($result){
      echo $user->image_path_and_placeholder();
    } else {
      echo $result;
    }
  }

  if (isset($_GET['photo_id'])) {
    $photo = Photo::find_by_id($_GET['photo_id']);
    $photo = json_encode($photo);
    echo $photo;
  }


?>