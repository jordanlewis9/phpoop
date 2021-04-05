<?php include("includes/header.php"); ?>
<?php
  if (isset($_POST['create'])) {
    $user = new User();
    $user->username = $_POST['username'];
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->password = $_POST['password'];

    if ($user->set_file($_FILES['user_image'])) {
      $user->save_user_and_image();
    } else {
      $error_message = array_shift($user->custom_errors);
      $session->message_action($error_message);
      redirect("add_user.php");
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
    <p class="bg-fail"><?php echo $session->message_action(); ?></p>
        <h1 class="page-header">
            Add User
        </h1>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="col-md-6 col-md-offset-3">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" class="form-control" id="username">
            </div>
            <div class="form-group">
              <label for="first_name">First Name</label>
              <input type="text" name="first_name" class="form-control" id="first_name">
            </div>
            <div class="form-group">
              <label for="last_name">Last Name</label>
              <input type="text" name="last_name" class="form-control" id="last_name">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" name="password" class="form-control" id="password">
            </div>
            <div class="form-group">
              <label for="user_image">User Image</label>
              <input type="file" name="user_image" id="user_image">
            </div>
            <div class="form-group">
              <input type="submit" name="create" class="btn btn-primary pull-right">
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