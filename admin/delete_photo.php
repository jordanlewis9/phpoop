<?php ob_start(); ?>
<?php require_once("includes/init.php"); ?>
<?php

if (!$session->is_signed_in()) {
    redirect("login.php");
}

if (empty($_GET['photo_id'])) {
  redirect("photos.php");
}

$photo = Photo::find_by_id($_GET['photo_id']);

if ($photo) {
  if ($photo->delete_photo()) {
    redirect("photos.php?message=Photo successfully deleted");
  }
} else {
  redirect("photos.php");
}

?>