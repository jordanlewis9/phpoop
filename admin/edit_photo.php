<?php include("includes/header.php"); ?>
<?php
  if (empty($_GET['photo_id'])) {
    redirect("photos.php");
  } else {
    $photo = Photo::find_by_id($_GET['photo_id']);
  }
  if (isset($_GET['message'])) {
    $message = $_GET['message'];
  }
  if(isset($_POST['update'])) {
    if ($photo) {
      $photo->title = $_POST['title'];
      $photo->caption = $_POST['caption'];
      $photo->alt_text = $_POST['alt_text'];
      $photo->description = $_POST['description'];
      $photo->save();
    }
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
            Edit Photo
            <small>Subheading</small>
<?php
if (isset($message)) {
    echo "<h2>{$message}</h2>";
}
?>
        </h1>
        <form action="" method="POST">
          <div class="col-md-8">
            <div class="form-group">
              <input type="text" name="title" class="form-control" value="<?php echo $photo->title; ?>">
            </div>
            <div class="form-group">
              <a href="#" class="thumbnail"><img src="<?php echo $photo->picture_path(); ?>" alt="<?php echo $photo->alt_text; ?>"></a>
            </div>
            <div class="form-group">
              <label for="caption">Caption</label>
              <input type="text" name="caption" class="form-control" value="<?php echo $photo->caption; ?>">
            </div>
            <div class="form-group">
              <label for="alt_text">Alternate Text</label>
              <input type="text" name="alt_text" class="form-control" value="<?php echo $photo->alt_text; ?>">
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea id="editor" class="form-control" name="description"><?php echo $photo->description; ?></textarea>
            </div>
          </div>
          <div class="col-md-4" >
            <div  class="photo-info-box">
              <div class="info-box-header">
                <h4>Save <span id="toggle" class="glyphicon glyphicon-menu-up pull-right"></span></h4>
              </div>
              <div class="inside">
                <div class="box-inner">
                  <p class="text">
                    <span class="glyphicon glyphicon-calendar"></span> Uploaded on: April 22, 2030 @ 5:26
                  </p>
                  <p class="text ">
                  Photo Id: <span class="data photo_id_box">34</span>
                  </p>
                  <p class="text">
                  Filename: <span class="data">image.jpg</span>
                  </p>
                  <p class="text">
                  File Type: <span class="data">JPG</span>
                  </p>
                  <p class="text">
                  File Size: <span class="data">3245345</span>
                  </p>
                </div>
                <div class="info-box-footer clearfix">
                  <div class="info-box-delete pull-left">
                    <a  href="delete_photo.php?photo_id=<?php echo $photo->id; ?>" class="btn btn-danger btn-lg ">Delete</a>   
                  </div>
                  <div class="info-box-update pull-right ">
                    <input type="submit" name="update" value="Update" class="btn btn-primary btn-lg ">
                  </div>
                </div>
              </div>
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