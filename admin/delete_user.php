<?php ob_start(); ?>
<?php require_once("includes/init.php"); ?>
<?php

if (!$session->is_signed_in()) {
    redirect("login.php");
}

if (empty($_GET['user_id'])) {
  redirect("users.php");
}

$user = User::find_by_id($_GET['user_id']);

if ($user) {
  if ($user->delete()) {
    $user->delete_user_photo();
    $session->message_action("The user has been successfully deleted.");
    redirect("users.php");
  }
} else {
  $session->message_action("There was an error deleting the user.");
  redirect("users.php");
}

?>