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
    $session->message_action("The photo {$photo->filename} has been deleted.");
    redirect("photos.php?message=Photo successfully deleted");
  }
} else {
  $session->message_action("There has been an error deleting photo {$photo->filename}.");
  redirect("photos.php");
}

?>