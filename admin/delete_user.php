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
    redirect("users.php?message=User successfully deleted");
  }
} else {
  redirect("users.php");
}

?>