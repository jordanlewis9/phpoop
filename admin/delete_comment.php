<?php ob_start();
require_once("includes/init.php"); 

if(!$session->is_signed_in()) {
  redirect('comments.php');
}

if (!isset($_GET['page'])) {
  redirect('comments.php');
}

if (isset($_GET['photo_id'])) {
  $photo_id = $_GET['photo_id'];
} else {
  $photo_id = "";
}

$page = $_GET['page'];

if (!isset($_GET['comment_id'])) {
  redirect("{$page}.php");
} else {
  if ($comment = Comment::find_by_id($_GET['comment_id'])) {
    if ($comment->delete()) {
      redirect("{$page}.php?message=Comment successfully deleted&photo_id={$photo_id}");
    } else {
      redirect("{$page}.php?message=There was an error attempting to delete the comment&photo_id={$photo_id}");
    }
  } else {
    redirect("{$page}.php?message=No comment exists with that id number&photo_id={$photo_id}");
  }
}


?>
