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
    <a href="https://mail.google.com/mail/?view=cm&fs=1&to=juweriafatima7289@gmail.com" target="_blank" class="p-3">Mail Us</a>

    <a href="logout.php" class="btn btn-danger">Logout</a>


    <form class="d-flex" method="get">
      <input class="form-control me-2" type="search" placeholder="Search" name="search">
      <button class="btn btn-outline-success" type="submit" name="find">Search</button>
    </form>
  </div>
</nav>

<div class="container mt-3">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <?php 
                $fetch = mysqli_query($con,"select users.name,posts.content,posts.post_time,posts.image,posts.post_id from users join posts on users.id = posts.user_id where email = '$email'");
                while($rows=mysqli_fetch_array($fetch)){?>
                <div class="col-lg-4 mb-2">
                    <div class="card" style="height:420px">
                            <img src="images/<?php echo $rows['image'];?>" alt="" class="card-img-top" height="200px">
                        <div class="card-body">
                            <p class="card-title">Wriiten by :-<?php echo $rows['name'];?></p>
                            <p class="card-text"><?php echo $rows['content'];?></p>
                            <p><?php echo $rows['post_time'];?></p>
                        </div>
                        <div class="card-footer">
                            <a href="edit.php?edit=<?=$rows['post_id'];?>" class="btn btn-primary">edit</a>
                            <a href="delete.php?del=<?=$rows['post_id'];?>" class="btn btn-danger">X</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

</body>
</html>
