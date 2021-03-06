<?php include("includes/header.php"); ?>
<?php 
    $photos = Photo::find_all();
    if (isset($_GET['message'])) {
        $message = $_GET['message'];
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
    <p class="bg-success"><?php echo $session->message_action(); ?></p>
        <h1 class="page-header">
            Photos
            <small>Subheading</small>
<?php
if (isset($message)) {
    echo "<h2>{$message}</h2>";
}
?>
        </h1>
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Id</th>
                        <th>File Name</th>
                        <th>Title</th>
                        <th>Size</th>
                        <th>Total Comments</th>
                    </tr>
                </thead>
                <tbody>
                <?php

foreach ($photos as $photo) {
    $num_comments = count(Comment::find_the_comments($photo->id));
    echo "
    <tr>
    <td>
        <img src='{$photo->picture_path()}' class='admin-photo-thumbnail' alt='{$photo->alt_text}'>
        <div class='pictures_link'>
            <a href='delete_photo.php?photo_id={$photo->id}'>Delete</a>
            <a href='edit_photo.php?photo_id={$photo->id}'>Edit</a>
            <a href='../photo.php?photo_id={$photo->id}'>View</a>
        </div>
    </td>
    <td>{$photo->id}</td>
    <td>{$photo->filename}</td>
    <td>{$photo->title}</td>
    <td>{$photo->size}</td>
    <td><a href='photo_comments?photo_id={$photo->id}'>{$num_comments}</a></td>
    </tr>";
}
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.row -->

</div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>