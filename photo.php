<?php 
require_once("admin/includes/init.php");

if (empty($_GET['photo_id'])) {
    redirect("index.php");
}
$photo = Photo::find_by_id($_GET['photo_id']);

if (isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);
    $photo_id = $photo->id;

    $new_comment = Comment::create_comment($photo_id, $author, $body);
    if ($new_comment && $new_comment->save()) {
        redirect("photo.php?photo_id=$photo_id");
    } else {
        $message = "There was a problem saving your comment.";
    }
}

$comments = Comment::find_the_comments($photo->id);

?>
<?php require_once("includes/header.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#"><?php echo $photo->id?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/<?php echo $photo->upload_directory . DS . $photo->filename; ?>" alt="<?php echo $photo->alt_text; ?>">

                <hr>

                <!-- Post Content -->

                <p class="lead"><?php echo $photo->caption; ?></p>
                <p><?php echo $photo->description; ?></p>

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="POST" action="">
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" name="author" class="form-control" id="author">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="body" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

<?php

foreach($comments as $comment) {
    echo "                <div class='media'>
    <a class='pull-left' href='#'>
        <img class='media-object' src='http://placehold.it/64x64' alt=''>
    </a>
    <div class='media-body'>
        <h4 class='media-heading'>{$comment->author}
        </h4>
        {$comment->body}
    </div>
</div>";
}

?>

            </div>

            <!-- Blog Sidebar Widgets Column -->


        </div>
        <!-- /.row -->

<?php require_once('includes/footer.php'); ?>
