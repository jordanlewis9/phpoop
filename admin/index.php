<?php include("includes/header.php"); ?>
<?php

if (!$session->is_signed_in()) {
    redirect("login.php");
}

// $user = new User();
// $user->username = "connor";
// $user->password = "abc";
// $user->first_name = "Connor";
// $user->last_name = "Lewis";
// $user->create();
?>

        <!-- Navigation -->

            <!-- Top Menu Items -->
<?php include("includes/top_nav.php"); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
<?php include("includes/side_nav.php"); ?>

        <div id="page-wrapper">
<?php include("includes/admin_content.php"); ?>
<!-- /.row -->
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>