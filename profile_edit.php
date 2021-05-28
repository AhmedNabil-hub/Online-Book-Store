<?php

  if (!isset($_SESSION['user_data'])){
    redirect("profile.php");
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = filter_var(
      $_POST['username'],
      FILTER_SANITIZE_STRING
    );

    $email = filter_var(
      $_POST['email'],
      FILTER_SANITIZE_EMAIL
    );

    $full_name = filter_var(
      $_POST['full_name'],
      FILTER_SANITIZE_STRING
    );

    $formErrors = array();

    if (empty($username) || strlen($username) < 3) {
      $formErrors[] = "please type a valid username";
    }

    if (empty($email)) {
      $formErrors[] = "please type a valid email";
    }

    if (empty($full_name)) {
      $formErrors[] = "please type a valid full name";
    }

    
    if (empty($formErrors)) {

      $old_username = $_SESSION['user_data']['username'];
      $old_email = $_SESSION['user_data']['email'];

      $count_username = count(get_data(
        "users",
        "username",
        "username=$username",
        "WHERE username=:username"
      ));

      $count_email = count(get_data(
        "users",
        "username",
        "email=$email",
        "WHERE email=:email"
      ));

      if ($username !== $old_username && $count_username > 0){
        $formErrors [] = "This username exists";
      }
      elseif ($email !== $old_email && $count_email > 0) {
        $formErrors [] = "This email exists";
      }
      elseif (!edit_data(
        "users",
        "username=:username,email=:email,full_name=:full_name",
        "username=$username,email=$email,full_name=$full_name,old_username=$old_username",
        "WHERE username=:old_username"
      )){
        $formErrors [] = "failed to edit user";
      }
      else{
        if ($username !== $old_username){
          $_SESSION['user'] = $username;
        }
        redirect('dashboard.php?dashpage=profile');
        exit();
      }
    }
    else{
      $formErrors [] = "failed to edit user";
    }
  }

?>
<div class="container-fluid">

  <!-- Content Row -->
  <div class="row">
    <div class="container">
      <div class="main-body">
        <div class="row">
          <div class="col-md-4 mb-3">
            <div class="card">
              <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                  <img src="<?php echo $_SESSION['user_data']['profile_photo'] ?>" alt="Admin" class="rounded-circle"
                    width="150">
                  <div class="mt-3">
                    <h4><?php echo $_SESSION['user_data']['username'] ?></h4>
                    <p class="text-secondary mb-1">Admin</p>
                    </p>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="col-lg-8">
            <div class="card">
              <div class="card-body">
                <form action="?dashpage=profile_edit"
                  method="POST">
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Full Name</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" class="form-control" value="<?php echo $_SESSION['user_data']['full_name'] ?>" name="full_name"
                  placeholder="Full Name" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Email</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" class="form-control" value="<?php echo $_SESSION['user_data']['email'] ?>" name="email"
                  placeholder="Email" required>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Username</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" class="form-control" value="<?php echo $_SESSION['user_data']['username'] ?>" name="username"
                  placeholder="Username" required>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9 text-secondary">
                    <button class="btn btn-primary px-4" type="submit">Save changes</button>
                    </div>
                  </div>
                </form>
                <?php
                  if (!empty($formErrors)){
                    foreach ($formErrors as $error) {
                      echo "<div class='row' role='alert'>";
                        echo "<div class='col-sm-3'></div>";
                        echo "<div class='col-sm-9 mt-3'>";
                          echo "<div class='alert-icon' style='display:inline-block;margin-right:10px'>";
                            echo "<svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x-circle-fill' viewBox='0 0 16 16'>";
                              echo "<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z'/>";
                            echo "</svg>";
                          echo "</div>";
                          echo "<span>". $error ."</span>";
                        echo "</div>";
                      echo "</div>";
                    }
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
