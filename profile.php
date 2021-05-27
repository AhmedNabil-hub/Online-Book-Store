<?php

  if (isset($_SESSION['user'])){

    $username = $_SESSION['user'];
    $user = get_data(
      "users",
      "full_name,email,username,profile_photo,user_id",
      "username=$username",
      "WHERE username=:username",
      "LIMIT 1"
    );

    if (count($user) > 0){
      $username = $user[0]['username'];
      $full_name = $user[0]['full_name'];
      $email = $user[0]['email'];
      if (isset($user[0]['profile_photo'])){
        $profile_photo = $user[0]['profile_photo'];
      } else {
        $profile_photo = "https://bootdey.com/img/Content/avatar/avatar7.png";
      }
      $user_id = $user[0]['user_id'];
    }

    $_SESSION['user_data'] = array(
      'username' => $username,
      'full_name' => $full_name,
      'email' => $email,
      'profile_photo' => $profile_photo,
      'user_id' => $user_id
    );
    
  } else {
    redirect("login.php");
    exit();
  }

?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Content Row -->
  <div class="row">
    <div class="container">
      <div class="main-body">

        <div class="row gutters-sm">
          <div class="col-md-4 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <img src="<?php echo $profile_photo ?>" alt="Admin" class="rounded-circle" width="150">
                  <div class="mt-3">
                    <h4><?php echo $username ?></h4>
                    <p class="text-secondary mb-1">Admin</p>
                    </p>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-8">
            <div class="card mb-3">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Full Name</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php echo $full_name; ?>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Email</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php echo $email; ?>
                  </div>
                </div>
                <hr>
                <div class="row">
                  <div class="col-sm-3">
                    <h6 class="mb-0">Username</h6>
                  </div>
                  <div class="col-sm-9 text-secondary">
                    <?php echo $username; ?>
                  </div>
                </div>

                <hr>
                <div class="row">
                  <div class="col-sm-12">
                    <a class="btn btn-primary" href="?dashpage=profile_edit">Edit</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->