<?php

  $pageTitle = 'auth';
  $no_nav = '';

  session_start();

  include './init.php';

  if (isset($_SESSION['user'])){
    redirect('dashboard.php');
    exit();
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = filter_var(
      $_POST['username'],
      FILTER_SANITIZE_STRING
    );

    $password = sha1(
      filter_var(
        $_POST['password'],
        FILTER_SANITIZE_STRING
      )
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

    if (empty($password)) {
      $formErrors[] = "please type a valid password";
    }

    if (empty($email)) {
      $formErrors[] = "please type a valid email";
    }

    if (empty($full_name)) {
      $formErrors[] = "please type a valid full name";
    }

    if (empty($formErrors)) {

      $user_name = get_data(
        "users",
        "username",
        "username=$username",
        "WHERE username=:username"
      );

      $user_email = get_data(
        "users",
        "username",
        "email=$email",
        "WHERE email=:email"
      );
      
      if (count($user_name) > 0){
        $formErrors [] = "This username exists";
      }
      elseif (count($user_email) > 0) {
        $formErrors [] = "This email exists";
      } elseif (!add_data(
        "users",
        "username,password,email,full_name",
        ":username,:password,:email,:full_name",
        "username=$username,password=$password,email=$email,full_name=$full_name"
      )){
        $formErrors [] = "failed to signup";
      }
      else {
        redirect('login.php');
        exit();
      }
    }
    else{
      $formErrors [] = "failed to signup";
    }
  }
?>

<div class="container">
  <div class="row px-3">
    <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
      <div class="img-left2 d-none d-md-flex"></div>
      <div class="card-body">
        <h3 class="title-text-center-mt-12">
          Creat Account
        </h3>
        <form class="form-box px3" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="floatingInput" name="username" placeholder="Username"
              pattern="^[a-zA-Z]{2,}[._]?[a-zA-Z0-9]+$" required>
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating mb-4">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email"
              required>
            <label for="floatingInput">Email</label>
          </div>
          <div class="form-floating mb-4">
            <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password"
              pattern=".{8,}" required>
            <label for="floatingPassword">Password</label>
          </div>
          <div class="form-floating mb-4">
            <input type="text" class="form-control" id="floatingPassword" name="full_name" placeholder="Full Name"
              required>
            <label for="floatingInput">Full Name</label>
          </div>

          <div class="mb-4">
            <button type="submit" class="btn btn-block text-uppercase">
              Sign up
            </button>
          </div>
          <div class="text-center mb-2">
            have an account?
            <a href="login.php" class="register-link">
              Login
            </a>
          </div>

        </form>
        <?php
          if (!empty($formErrors)){
            foreach ($formErrors as $error) {
              echo "<div class='row' role='alert'>";
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



<?php
  include $layouts . 'footer.php';
?>
