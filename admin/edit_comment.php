<?php include("includes/header.php"); ?>
<?php
  if (empty($_GET['comment_id'])) {
    redirect('comments.php');
  }

  if (isset($_GET['message'])) {
    $message = $_GET['message'];
  }

  $comment = Comment::find_by_id($_GET['comment_id']);

  if (isset($_POST['update'])) {
    $comment->author = $_POST['author'];
    $comment->photo_id = (int)$_POST['photo_id'];
    $comment->body = $_POST['body'];
    $comment->save();
    redirect("edit_comment.php?comment_id={$comment->id}&message=Comment edit successful");
  }

?>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">SB Admin</a>
            </div>
            <!-- Top Menu Items -->
<?php include("includes/top_nav.php"); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php include("includes/side_nav.php"); ?>

        <div id="page-wrapper">
        <div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Edit Comment
        </h1>
<?php
if (isset($message)) {
  echo "<h2>{$message}</h2>";
}
?>
        <form action="" method="POST">
          <div class="col-md-6 col-l-offset-3">
            <div class="form-group">
              <label for="author">Author</label>
              <input type="text" name="author" class="form-control" id="author" value="<?php echo $comment->author; ?>">
            </div>
            <div class="form-group">
              <label for="photo_id">Photo Id</label>
              <input type="text" name="photo_id" class="form-control" id="photo_id" value="<?php echo $comment->photo_id; ?>">
            </div>
            <div class="form-group">
              <label for="body">Comment</label>
              <textarea name="body" class="form-control" id="body"><?php echo $comment->body; ?></textarea>
            </div>
            <div class="form-group">
              <a href="delete_comment.php?comment_id=<?php echo $comment->id; ?>&page=comments" class="btn btn-danger">Delete</a>
              <input type="submit" name="update" class="btn btn-primary pull-right" value="Update">
            </div>
          </div>
      </form>
    </div>
</div>
<!-- /.row -->

</div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>