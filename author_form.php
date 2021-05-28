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
              <label class="col-sm-2 col-form-label" for="ExampleLanguage">Language &nbsp; </label>
              <select class="custom-select my-1 mr-auto" id="ExampleLanguage" name="author_language" required>
                <option selected>Choose</option>
                <option value="arabic">Arabic</option>
                <option value="chinese">Chinese (Mandarin)</option>
                <option value="dutch">Dutch</option>
                <option value="english">English</option>
                <option value="french">French</option>
                <option value="german">German</option>
                <option value="greek">Greek</option>
                <option value="hindi">Hindi</option>
                <option value="italian">Italian</option>
                <option value="japanese">Japanese</option>
                <option value="korean">Korean</option>
                <option value="portuguese">Portuguese</option>
                <option value="russian">Russian</option>
                <option value="spanish">Spanish</option>
                <option value="swahili">Swahili</option>
                <option value="swedish">Swedish </option>
                <option value="turkish">Turkish</option>
              </select>
              <label class=" mr-5" for="ExampleCountry">Country</label>
              <select class="custom-select my-1 mr-auto" id="ExampleCountry" name="author_country" required>
                <option selected>Choose</option>
                <option value="Australia">Australia</option>
                <option value="Canada">Canada</option>
                <option value="China">China</option>
                <option value="Egypt">Egypt</option>
                <option value="France">France</option>
                <option value="Germany">Germany</option>
                <option value="Greece">Greece</option>
                <option value="India">India</option>
                <option value="Italy">Italy</option>
                <option value="Japan">Japan</option>
                <option value="Jordan">Jordan</option>
                <option value="Netherlands">Netherlands</option>
                <option value="Poland">Poland</option>
                <option value="Portugal">Portugal</option>
                <option value="Russian Federation">Russian Federation</option>
                <option value="Saudi Arabia">Saudi Arabia</option>
                <option value="Spain">Spain</option>
                <option value="Sweden">Sweden</option>
                <option value="Turkey">Turkey</option>
                <option value="United Kingdom">United Kingdom</option>
                <option value="United States">United States</option>
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
