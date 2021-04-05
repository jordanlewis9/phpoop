<?php include("includes/header.php"); ?>
<?php 
    $users = User::find_all();
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
    <p class="bg-success">
<?php echo $session->message_action(); ?>
    </p>
        <h1 class="page-header">
            Users
        </h1>
        <a href="add_user.php" class="btn btn-primary">Add User</a>
        <div class="col-md-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Photo</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                    </tr>
                </thead>
                <tbody>
                <?php

foreach ($users as $user) {
    echo "
    <tr>
    <td>{$user->id}</td>
    <td>
        <img src='{$user->image_path_and_placeholder()}' class='admin-user-thumbnail user_image'>
    </td>
    <td>{$user->username}
    <div class='action_links'>
            <a href='delete_user.php?user_id={$user->id}'>Delete</a>
            <a href='edit_user.php?user_id={$user->id}'>Edit</a>
        </div>
    </td>
    <td>{$user->first_name}</td>
    <td>{$user->last_name}</td>
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