<?php

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $file = $_FILES['photo'];
    define('allowed_exts',['jpg', 'gif', 'jpeg', 'png']);
    define('max_size', 1024*1024*1024);
    $new_file_name = "";

    require 'check_upload_photo.php';


    
    $author_name = filter_var(
      $_POST['author_name'],
      FILTER_SANITIZE_STRING
    );


    $author_country = filter_var(
        $_POST['author_country'],
        FILTER_SANITIZE_STRING
      );

    $author_language = filter_var(
      $_POST['author_language'],
      FILTER_SANITIZE_STRING
    );

    $author_description = filter_var(
      $_POST['author_description'],
      FILTER_SANITIZE_STRING
    );

    $formErrors = array();

    if (empty($author_name) || strlen($author_name) < 3) {
      $formErrors[] = "please type a valid name";
    }

    if (empty($author_country) || $author_country == "Choose") {
      $formErrors[] = "please choose a country";
    }

    if (empty($author_language) || $author_language == "Choose") {
      $formErrors[] = "please choose a language";
    }

    if (empty($author_description)) {
      $formErrors[] = "please type a valid description";
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

      $authors = get_data(
        "authors",
        "author_name",
        "author_name=$author_name",
        "WHERE author_name=:author_name"
      );



      if (count($authors) > 0){
        $formErrors [] = "This author name exists";
      } elseif (!add_data(
        "authors",
        "author_name,author_country,author_language,author_description,author_photo",
        ":author_name,:author_country,:author_language,:author_description,:author_photo",
        "author_name=$author_name,author_country=$author_country,author_language=$author_language,author_description=$author_description,author_photo=$photo"
      )){
        $formErrors [] = "failed to add author";
      }
      else {
        redirect('dashboard.php?dashpage=author_table');
        exit();
      }
    }
    else{
      $formErrors [] = "failed to add author";
    }
  }
?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Authors</h1>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12">

      <!-- Default Card Example -->
      <div class="card mb-12">
        <div class="card-header">
          Add a New Author
        </div>
        <div class="card-body">
          <form action="?dashpage=author_form" method="POST"
            enctype="multipart/form-data">

            <div class="form-group row">
              <label for="ExampleAuthorName" class="col-sm-2 col-form-label">Author Name</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="ExampleAuthorName" name="author_name"
                  placeholder="Author Name" required>
              </div>
            </div>
            <div class="form-inline align-items-center">
              <label class="mr-5" for="ExampleLanguage">Language &nbsp; </label>
              <select class="custom-select my-1 mr-auto" id="ExampleLanguage" name="author_language" required>
                <option selected>Choose</option>
                <option value="arabic">عربي</option>
                <option value="english">English</option>
              </select>
              <label class=" mr-5" for="ExampleCountry">Country</label>
              <select class="custom-select my-1 mr-auto" id="ExampleCountry" name="author_country" required>
                <option selected>Choose</option>
                <option value="فلسطين">فلسطين</option>
                <option value="مصر">مصر</option>
                <option value="england">England</option>
              </select>
            </div>
            <div class="form-group row">
              <label for="ExampleAuthorDescription" class="col-sm-2 col-form-label">Description</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="ExampleAuthorDescription" name="author_description"
                  placeholder="Author description" required rows="3">
              </div>
            </div>
            <div class="form-group row">
              <label for="ExampleAuthorPhoto" class="col-sm-2 col-form-label">Author Photo</label>
              <div class="col-sm-10" rows="3">
                <input type="file" class="form-control-file" id="ExampleAuthorPhoto" name="photo">
              </div>
            </div>
            <button class="btn btn-primary btn-user btn-block" type="submit">Save</button>

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
</div>