<?php include("includes/header.php"); ?>
<?php
  if (empty($_GET['user_id'])) {
    redirect('users.php');
  }

  $user = User::find_by_id($_GET['user_id']);

  if (isset($_POST['update'])) {
    $user->username = $_POST['username'];
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    if (!empty($_POST['password'])) {
      $user->password = $_POST['password'];
    }

    if (!empty($_FILES['user_image']['name'])) {
      if($user->set_file($_FILES['user_image'])) {
        $user->save_user_and_image();
      }
    } else {
      $user->save_user_and_image();
    }
    redirect("edit_user.php?user_id={$user->id}");
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
            Add User
        </h1>
        <div class="col-md-6">
          <img src="<?php echo $user->image_path_and_placeholder(); ?>" class="img-responsive" alt="User image">
        </div>
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="col-md-6">
            <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" class="form-control" id="username" value="<?php echo $user->username; ?>">
            </div>
            <div class="form-group">
              <label for="first_name">First Name</label>
              <input type="text" name="first_name" class="form-control" id="first_name" value="<?php echo $user->first_name; ?>">
            </div>
            <div class="form-group">
              <label for="last_name">Last Name</label>
              <input type="text" name="last_name" class="form-control" id="last_name" value="<?php echo $user->last_name; ?>">
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
              <a href="delete_user.php?user_id=<?php echo $user->id; ?>" class="btn btn-danger">Delete</a>
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