<?php

  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $file = $_FILES['photo'];
    define('allowed_exts',['jpg', 'gif', 'jpeg', 'png']);
    define('max_size', 1024*1024*1024);
    $new_file_name = "";

    require 'check_upload_photo.php';
  
    $title = filter_var(
      $_POST['title'],
      FILTER_SANITIZE_STRING
    );

    $author_name = filter_var(
      $_POST['author_name'],
      FILTER_SANITIZE_STRING
    );

    $category = filter_var(
        $_POST['category'],
        FILTER_SANITIZE_STRING
      );

    $book_language = filter_var(
      $_POST['book_language'],
      FILTER_SANITIZE_STRING
    );

    $book_description = filter_var(
      $_POST['book_description'],
      FILTER_SANITIZE_STRING
    );

    $published_at = filter_var(
      $_POST['published_at'],
      FILTER_SANITIZE_STRING
    );

    $formErrors = array();

    if (empty($title) || strlen($title) < 3) {
      $formErrors[] = "please type a valid title";
    }

    if (empty($author_name) || $author_name == "Choose") {
      $formErrors[] = "please choose a category";
    }

    if (empty($category) || $category == "Choose") {
      $formErrors[] = "please choose a category";
    }

    if (empty($book_language) || $book_language == "Choose") {
      $formErrors[] = "please choose a language";
    }

    if (empty($book_description)) {
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

      $author = get_data(
        "authors",
        "author_name,author_id",
        "author_name=$author_name",
        "WHERE author_name=:author_name"
      );


      if (count($author) < 1){
        $formErrors [] = "This author name doesn't exist. Please add this author first";
      } elseif (!add_data(
        "books",
        "title,book_description,book_language,category,published_at,book_cover",
        ":title,:book_description,:book_language,:category,:published_at,:book_cover",
        "title=$title,book_description=$book_description,book_language=$book_language,category=$category,published_at=$published_at,book_cover=$photo"
      )){
        $formErrors [] = "failed to add book";
      }
      else {
        $author_id = $author[0]['author_id'];
        $book_id = get_data(
          "books",
          "book_id",
          "title=$title",
          "WHERE title=:title",
          "LIMIT 1"
        )[0]["book_id"];
        if(!add_data(
          "book_auth",
          "book_id,author_id",
          ":book_id,:author_id",
          "book_id=$book_id,author_id=$author_id"
          )){
            $formErrors [] = "failed to add this book to his author";
          }
          else{
            redirect('dashboard.php?dashpage=book_table');
            exit();
          }
      }
    }
    else{
      $formErrors [] = "failed to add book";
    }
  }

?>

<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Books</h1>
  </div>

  <!-- Content Row -->
  <div class="row">
    <div class="col-lg-12">

      <!-- Default Card Example -->
      <div class="card mb-12">
        <div class="card-header">
          Add a New Book
        </div>
        <div class="card-body">
          <form action="?dashpage=book_form" method="POST" enctype="multipart/form-data">
            <div class="form-group row">
              <label for="ExampleBookTitle" class="col-sm-2 col-form-label">Book Title</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="ExampleBookTitle" placeholder="Book Title" name="title"
                  required>
              </div>
            </div>
            <div class="form-group row">
              <label for="ExampleAuthorName" class="col-sm-2 col-form-label">Author Name</label>
              <div class="col-sm-10">
                <select class="custom-select my-1 mr-auto" id="ExampleLanguage" name="author_name" required>
                <option selected>Choose</option>
                <?php 
                  $authors = get_data(
                    "authors",
                    "DISTINCT author_name",
                    null,
                    null,
                    null,
                    "ORDER BY author_name ASC"
                  );

                  foreach($authors as $author){
                    echo "<option value='". $author['author_name'] ."'>". ucfirst($author['author_name']) ."</option>";
                  }
                ?>
              </select>
              </div>
            </div>
            <div class="form-inline align-items-center">
              <label class="col-sm-2 col-form-label" for="ExampleLanguage">Language &nbsp; </label>
              <select class="custom-select my-1 mr-auto" id="ExampleLanguage" name="book_language" required>
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
              <label class="col-sm-2 col-form-label" for="inlineFormCustomSelectPref">Book Category</label>
              <select class="custom-select my-1 mr-auto" id="inlineFormCustomSelectPref" name="category" required>
                <option selected>Choose</option>
                <?php 
                  $categories = get_data(
                    "books",
                    "DISTINCT category",
                    null,
                    null,
                    null,
                    "ORDER BY category ASC"
                  );

                  foreach($categories as $category){
                    echo "<option value='". strtolower($category['category']) ."'>". ucfirst($category['category']) ."</option>";
                  }
                ?>
              </select>

              <label for="PublicationDate" class="col-sm-2 col-form-label">Publication Date</label>
              <input type="date" class="custom-select" id="PublicationDate" name="published_at" required>
            </div>
            <div class="form-group row">
              <label for="ExampleBookDescription" class="col-sm-2 col-form-label">Book Description</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="ExampleBookDescription" placeholder="Book Description"
                  name="book_description" required>
              </div>
            </div>
            <div class="form-group row">
              <label for="ExampleCoverPhoto" class="col-sm-2 col-form-label">Book Cover Photo</label>
              <div class="col-sm-10">
                <input type="file" class="form-control-file" id="ExampleCoverPhoto" name="photo">
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
