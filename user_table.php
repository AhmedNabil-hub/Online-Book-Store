<?php

  $users = get_data(
    "users",
    "user_id,username,password,email,full_name,created_at"
  );

  if (isset($_GET['action']) && $_GET['action'] == 'delete'){

    $id = $_GET['id'];

    if($_GET['id'] != $_SESSION['id']){
      delete_data(
        "users",
        "user_id=$id",
        "WHERE user_id=:user_id"
      );
  
    } 
    else{
      echo"<script>alert('Deleting signed in user is not allowed')</script>";
    }
    
    redirect("dashboard.php?dashpage=user_table");
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
      <h6 class="m-0 font-weight-bold text-primary">System Users</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              <th>Password</th>
              <th>Email</th>
              <th>Full Name</th>
              <th>Created at</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($users as $user){
              echo "<tr>";
                foreach ($user as $field){
                  echo "<th>" . $field . "</th>";
                }
                echo "<th>";
                echo "<a class='btn btn-danger' href='?dashpage=user_table&action=delete&id=". $user['user_id'] . "'>Delete</a>";
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