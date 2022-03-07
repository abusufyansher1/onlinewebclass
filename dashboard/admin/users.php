<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Online php</title>
  <?php

  include'../DB/connection.php';

  if(isset($_POST['submit']) AND $_POST['type']=="adduser")
  {
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $role_id=$_POST['role_id'];
    $query3=$conn->query("insert into users(name,email,password,role_id) 
      values('$name','$email','$password','$role_id')");
    if($query3)
    {
      $_SESSION['data']="<div class='alert alert-info'>Data uploaded</div>";
    }
    else{
      $_SESSION['data']="<div class='alert alert-danger'>Internal Error</div>";
    }
    header("location:users.php");
    exit();
  }
  if(isset($_GET['type']) && $_GET['type']=="changestatus")
  {
    $status=$_GET['status'];
    $userid=$_GET['userid'];
    if($status==0)
    {
      $newstatus=1;
    }
    elseif($status==1)
    {
      $newstatus=0;
    }
    $query4=$conn->query("update users set active_status='$newstatus' where id='$userid'");
    if($query4)
    {
      $_SESSION['data']="<div class='alert alert-info'>Data updated</div>";
    }
    else{
      $_SESSION['data']="<div class='alert alert-danger'>Internal error</div>";
    }
    header("location:users.php");
    exit();
  }

   include'header.php';?>
 
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- sidebar -->
  <?php include'sidebar.php';?>
  <!-- end -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
      <?php if(isset($_SESSION['data']))
      {
        echo $_SESSION['data'];
        unset($_SESSION['data']);
      }?>
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Users</h3>

          <div class="card-tools">
            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduser">
 Add user
</button>
            </button>
          </div>
        </div>

        <div class="card-body">
          <?php $query=$conn->query("select *,users.id as userid from users inner join roles on roles.id=users.role_id");?>
          <table class='table'>
            <thead>
              <tr><td>Name</td><td>Role</td><td>Status</td>
              </tr>
            </thead>
            <tbody>
              <?php while($row=$query->fetch_array())
              {
                if($row['active_status']==0)
                {
                  $status="<span class='badge badge-info'>Active</span>";

                }
                elseif($row['active_status']==1){
                  $status="<span class='badge badge-danger'>Suspended</span>";
                }
                ?>
                  <tr>
                <td><?= $row['name'];?></td><td><?= $row['role_name'];?></td>
                <td><?= $status;?></td>
                <td><a href="users.php?type=changestatus&&userid=<?= $row['userid'];?>&&status=<?= $row['active_status'];?>">Change status</td>
              </tr>
              <?php }?>
              
            </tbody>
          </table>
         
        </div>
        <!-- /.card-body -->
        
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include'footer1.php';?>
  <!-- footer -->
  <?php include'footer.php';?>
  <!-- end -->

 
</div>
<!-- ./wrapper -->



<!-- Modal -->
<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
       <form action="users.php" method="post">
         <label>Name</label>
         <input type="" name="name" required class="form-control">

         <label>Email</label>
         <input type="email" name="email" required class="form-control">

         <label>Password</label>
         <input type="password" name="password" required class="form-control">
         <?php $query2=$conn->query("select * from roles");?>

         <label>Role</label>
         <select name='role_id' required="">
           <option>Select role</option>
           <?php
            while($row2=$query2->fetch_array())
            { ?>
                <option value="<?= $row2['id'];?>"><?= $row2['role_name'];?></option>
            <?php }
           ?>
         </select> 
         <input type="hidden" name="type" value='adduser'>
         <input type="submit" name="submit" class="form-control btn btn-info">
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>


</body>
</html>
