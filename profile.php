<?php
    include "config.php";
    session_start();
    $email = $_SESSION['user_email'];

    $q = mysqli_query($con,"select * from users where email ='$email'");
    $row = mysqli_fetch_array($q);
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alien</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand"><?php echo $row['name'];
 ?></a>
    <a href="logout.php" class="btn btn-danger">Logout</a>
    <a href="my_posts.php" class="btn btn-primary">My posts</a>


    <form class="d-flex" method="get">
      <input class="form-control me-2" type="search" placeholder="Search" name="search">
      <button class="btn btn-outline-success" type="submit" name="find">Search</button>
    </form>
  </div>
</nav>

<div class="container mt-5">
    <div class="row">
        <div class="col-lg-5 mx-auto">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th>Name</th>
                    <td><?=$row['name'];?>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?=$row['email'];?>
                </tr>
            </table>
        </div>
    
    </div>
</div>