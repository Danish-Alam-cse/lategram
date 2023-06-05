<?php
    include "config.php";
    session_start();
    $email = $_SESSION['user_email'];
    if(!$email){
        header("location: login.php");
    }
    if(isset($_GET['more'])){
        $more = $_GET['more'];
        $fetch = mysqli_query($con,"select users.name,posts.content,posts.post_time,posts.image,posts.post_id from users join posts on users.id = posts.user_id where posts.post_id = '$more'");
        $row = mysqli_fetch_array($fetch);

    }
 
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
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <img src="images/<?=$row['image'];?>"  height="500px" alt="">
        </div>
        <div class="col-lg-4">
            <h1>Details</h1>
            <p><?=$row['content'];?>
            <h6><?=$row['name'];?></h6>

        </div>
    </div>
</div>