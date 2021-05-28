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

      </div>

    </div>
      <?php
        if (!empty($formErrors)){
          foreach ($formErrors as $error) {
            echo "<div class='alert alert-danger text-center'>";
              echo $error;
            echo "</div>";
          }
        }
      ?>

  </div>
</div>



<?php
  include $layouts . 'footer.php';
?>