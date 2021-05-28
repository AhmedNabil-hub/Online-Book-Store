<?php

  $users = get_data(
    "users",
    "user_id,username,full_name",
    null,
    null,
    "ORDER BY created_at DESC",
    "LIMIT 5"
  );

  $books = get_data(
    "books",
    "book_id,title,category",
    null,
    null,
    "ORDER BY created_at DESC",
    "LIMIT 5"
  );

  $count_users = get_data(
    "users",
    "COUNT(user_id) AS count",
  )[0]['count'];

  $count_books = get_data(
    "books",
    "COUNT(book_id) AS count",
  )[0]['count'];

  $count_authors = get_data(
    "authors",
    "COUNT(author_id) AS count",
  )[0]['count'];

  $count_categories = get_data(
    "books",
    "COUNT(DISTINCT category) AS count",
  )[0]['count'];

?>

<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Users Number Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Users Number</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_users; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-users fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Authors Number Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Authors Number</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_authors; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-brain fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Books Number Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Books Number</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_books; ?></div>
            </div>
            <div class="col-auto">
              <i class="fas fa-fw fa-book fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Categories Number Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                Categories Number</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count_categories; ?></div>
            </div>
            <div class="col-auto">
              <i class="fab fa-buffer fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

      <!-- Last Added Users table Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Last Added Users</h6>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">UserName</th>
                <th scope="col">Full Name</th>
              </tr>
            </thead>
            <tbody>
              <?php

                foreach($users as $user){
                  echo "<tr>";
                  echo"<th scope='col'>" . $user['user_id'] ."</th>";
                  echo"<th scope='col'>" . $user['username'] ."</th>";
                  echo"<th scope='col'>" . $user['full_name'] ."</th>";
                  echo"</tr>";
                }

              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

      <!-- Last Added Books Table Example -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Last Added Books</h6>
        </div>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Book Name</th>
                <th scope="col">Category</th>
              </tr>
            </thead>
            <tbody>
              <?php

                foreach($books as $book){
                  echo "<tr>";
                  echo"<th scope='col'>" . $book['book_id'] ."</th>";
                  echo"<th scope='col'>" . $book['title'] ."</th>";
                  echo"<th scope='col'>" . $book['category'] ."</th>";
                  echo"</tr>";
                }

              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- /.container-fluid -->