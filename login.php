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

    $formErrors = array();

    if (empty($username) || strlen($username) < 3) {
      $formErrors[] = "please type a valid username";
    }

    if (empty($password)) {
      $formErrors[] = "please type a valid password";
    }

    if (empty($formErrors)) {
      $user = get_data(
        "users",
        "user_id,username,password",
        "username=$username",
        "WHERE username=:username"
      );
      
      if (count($user) < 1){
        $formErrors [] = "This username doesn't exist";
      }
      elseif ($user[0]["password"] !== $password){
        $formErrors [] = "This password is incorrect";
      }
      else {
        $_SESSION['user'] = $user[0]["username"];
        $_SESSION['id'] = $user[0]["user_id"];

        redirect('dashboard.php');
        exit();

      }
    }
  }
?>

<div class="container">
  <div class="row px-3">
    <div class="col-lg-10 col-xl-9 card flex-row mx-auto px-0">
      <div class="img-left d-none d-md-flex"></div>
      <div class="card-body">
        <h4 class="title-text-center-mt-4-p 3">
          Login into account
        </h4>
        <form class="form-box px3" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
          <div class="form-floating mb-3">
            <input type="username" class="form-control" id="floatingInput" placeholder="Username" name="username"
              pattern="^[a-zA-Z]{2,}[._]?[a-zA-Z0-9]+$" required>
            <label for="floatingInput">Username</label>
          </div>
          <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password"
              pattern=".{8,}" required>
            <label for="floatingPassword">Password</label>
            <div class="alert alert-danger" class="row" role="alert">
                              <div class="alert-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                                  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                                </svg>
                              </div>
                
                              Password is incorrect
              </div>
          </div>
          <div class="mb-3">
            <button type="submit" class="btn btn-block text-uppercase">
              Login
            </button>
          </div>
          <div class="text-center mb-2">
            Don't have an account?
            <a href="signup.php" class="register-link">
              Register now
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
