<?php

  $authors = get_data(
    "authors",
    "author_id,author_name,author_description,author_country,author_language"
  );

  if (isset($_GET['action']) && $_GET['action'] == 'delete'){

    $id = $_GET['id'];

    $count_books = count(get_data(
      "book_auth",
      "author_id",
      "author_id=$id",
      "WHERE author_id=:author_id"
    ));

    if ($count_books < 1){
      delete_data(
        "authors",
        "author_id=$id",
        "WHERE author_id=:author_id"
      );
    }
    else {
      echo "<script>alert('Deleting authors that have books is not allowed. Please delete their books first!')</script>";
    }
    
    redirect("dashboard.php?dashpage=author_table");
  }

?>

<div class="container-fluid">

  <!-- Page Heading -->
  <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Users</h1>
                    </div> -->

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">System Authors</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Author Name</th>
              <th>Description</th>
              <th>Country</th>
              <th>Language</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
                    foreach ($authors as $author){
                      echo "<tr>";
                        foreach ($author as $field){
                          echo "<th>" . $field . "</th>";
                        }
                        echo "<th>";
                        echo "<a class='btn btn-danger' href='?dashpage=author_table&action=delete&id=". $author['author_id'] . "'>Delete</a>";
                      echo "</th>";
                      echo "</tr>";
                    }
                  ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
