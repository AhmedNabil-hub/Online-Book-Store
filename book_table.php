<?php

  $books = get_data(
    "books",
    "book_id,title,book_description,category,book_language, published_at,created_at"
  );

  if (isset($_GET['action']) && $_GET['action'] == 'delete'){

    $id = $_GET['id'];
    delete_data(
      "books",
      "book_id=$id",
      "WHERE book_id=:book_id"
    );

    redirect("dashboard.php?dashpage=book_table");
  }

?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Users</h1>
            </div> -->

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">System Books</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Book Title</th>
              <th>Description</th>
              <th>Category</th>
              <th>Language</th>
              <th>Publishing date</th>
              <th>Created at</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($books as $book){
              echo "<tr>";
                foreach ($book as $field){
                  echo "<th>" . $field . "</th>";
                }
                echo "<th>";
                echo "<a class='btn btn-danger' href='?dashpage=book_table&action=delete&id=". $book['book_id'] . "'>Delete</a>";
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
<!-- /.container-fluid -->