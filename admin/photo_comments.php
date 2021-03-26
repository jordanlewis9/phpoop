<?php include("includes/header.php"); ?>
<?php

if (!isset($_GET['photo_id'])) {
    redirect("photos.php");
}
if (isset($_GET['message'])) {
  $message = $_GET['message'];
}
$photo_id = $_GET['photo_id'];
$comments = Comment::find_the_comments($photo_id);
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
            Comments
        </h1>
    </div>
<?php
if (isset($message)) {
    echo "<h2>{$message}</h2>";
}
?>
</div>
<!-- /.row -->

<div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Content</th>
                    </tr>
                </thead>
                <tbody>
                <?php

foreach ($comments as $comment) {
    echo "
    <tr>
    <td>{$comment->id}</td>
    <td>{$comment->author}
    </td>
    <td>{$comment->body}
    <div class='action_links'>
    <a href='delete_comment.php?comment_id={$comment->id}&page=photo_comments&photo_id={$photo_id}'>Delete</a>
    <a href='edit_comment.php?comment_id={$comment->id}'>Edit</a>
    </div>
    </td>
    </tr>";
}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>