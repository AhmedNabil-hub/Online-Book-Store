<?php

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $file = $_FILES['photo'];
    define('allowed_exts',['jpg', 'gif', 'jpeg', 'png']);
    define('max_size', 1024*1024*1024);
    $new_file_name = "";

    require 'check_upload_photo.php';

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

    $formErrors = array_merge($formErrors, check_errors(
      $file['name'],
      $file['type'],
      $file['tmp_name'],
      $file['error'],
      $file['size'],
      $formErrors
    ));
    
    $photo = $new_file_name;

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
        "username,password,email,full_name,profile_photo",
        ":username,:password,:email,:full_name,:profile_photo",
        "username=$username,password=$password,email=$email,full_name=$full_name,profile_photo=$photo"
      )){
        $formErrors [] = "failed to add user";
      }
      else{
        redirect('dashboard.php?dashpage=user_table');
        exit();
      }
    }
    else{
      $formErrors [] = "failed to add user";
    }
  }

?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Users</h1>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12">

      <!-- Default Card Example -->
      <div class="card mb-12">
        <div class="card-header">
          Add a New User
        </div>
        <div class="card-body">
          <form action="?dashpage=user_form" method="POST"
            enctype="multipart/form-data">
            <div class="form-group row">
              <label for="ExampleFullName" class="col-sm-2 col-form-label">Full Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="ExampleFullName" name="full_name" placeholder="Full Name"
                  required>
              </div>
            </div>
            <div class="form-group row">
              <label for="ExampleUsername" class="col-sm-2 col-form-label">Username</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="ExampleUsername" name="username" placeholder="Username"
                  pattern="^[a-zA-Z]{2,}[._]?[a-zA-Z0-9]+$" required>
              </div>
            </div>

            <div class="form-group row">
              <label for="ExampleEmail" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="ExampleEmail" placeholder="name@example.com" name="email"
                  required>
              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
              <div class="col-sm-10">
                <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password"
                  pattern=".{8,}" required>

              </div>
            </div>
            <div class="form-group row">
              <label for="inputPassword" class="col-sm-2 col-form-label">Profile Picture</label>
              <div class="col-sm-10">
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="photo">
              </div>
            </div>

            <button class="btn btn-primary btn-user btn-block" type="submit">Save</button>

          </form>
          <?php
            if (!empty($formErrors)){
              foreach ($formErrors as $error) {
                echo "<div class='row' role='alert'>";
                  echo "<div class='col-sm-2'></div>";
                  echo "<div class='col-sm-10 mt-3'>";
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
