<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Dashboard
            <small>Subheading</small>
        </h1>
<?php

  $user = User::find_user_by_id(1);
  echo $user->username;
  echo "<br>";
  echo $user->id;
  echo "<br>";

//   $users = User::find_all_users();
//   foreach($users as $user) {
//     echo $user->username . "<br>";
//   }
  $user->last_name = "Lewis";
  $user->save();
// $user = new User();
// $user->username = "poop";
// $user->password = "abc";
// $user->first_name = "Poop";
// $user->last_name = "Things";
// $user->save();
?>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
            </li>
            <li class="active">
                <i class="fa fa-file"></i> Blank Page
            </li>
        </ol>
    </div>
</div>